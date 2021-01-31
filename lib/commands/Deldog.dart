import 'package:surake/interfaces/ICommand.dart';
import 'package:surake/main.dart';
import 'package:surake/services/deldog.dart';
import 'package:surake/utils/DocumentDownloader.dart';
import 'package:teledart/model.dart';
import 'package:teledart/src/teledart/model/message.dart';
import 'package:teledart/telegram.dart';
import 'package:surake/extensions/TeleDartMessage.dart';

class Deldog implements ICommand {
  final service = DeldogService();
  final downloader = DocumentDownloader();
  final telegram = getIt.get<Telegram>();

  @override
  String trigger = 'dd';

  @override
  TriggerMode triggerMode = TriggerMode.COMMAND;

  @override
  Future<void> runner(TeleDartMessage message) async {
    if (message.reply_to_message == null) return;

    var isFile = !(message.reply_to_message?.document == null);

    final msgRef =
        await message.replyMessage('DELDOG: Sending your content...');

    String content;

    if (isFile) {
      final doc = message.reply_to_message.document;

      if (doc.mime_type != 'text/plain') return;

      final file = await telegram.getFile(doc.file_id);

      content = await downloader.getAsString(file);
    } else {
      content = message.reply_to_message.text;
    }

    if (content == null) return;

    final ddURL = await service.pushContent(content);
    await message.editMessage('$ddURL', msgRef);
  }
}
