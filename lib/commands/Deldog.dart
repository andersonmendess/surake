import 'package:surake/interfaces/ICommand.dart';
import 'package:surake/main.dart';
import 'package:teledart/model.dart';
import 'package:teledart/src/teledart/model/message.dart';
import 'package:teledart/telegram.dart';

class Deldog implements ICommand {
  @override
  String trigger = 'dd';

  @override
  TriggerMode triggerMode = TriggerMode.COMMAND;

  @override
  Future<void> runner(TeleDartMessage message) async {
    var isFile = true;

    if (message.reply_to_message?.document == null) {
      isFile = false;
    }

    final telegram = getIt.get<Telegram>();

    Message warn;

    if (isFile) {
      final doc = message.reply_to_message.document;

      final file = await telegram.getFile(doc.file_id);

      print(file);

      warn = await message.reply("sending ${doc.file_name} to deldog");
    } else {
      final doc = message.reply_to_message.text;

      warn = await message.reply("sending ${doc} to deldog");
    }

    await Future.delayed(Duration(seconds: 7));

    telegram.editMessageText("done",
        message_id: warn.message_id, chat_id: warn.chat.id);
  }
}
