import 'package:surake/interfaces/ICommand.dart';
import 'package:surake/main.dart';
import 'package:teledart/src/teledart/model/message.dart';
import 'package:teledart/telegram.dart';

class JustText implements ICommand {
  @override
  Future<void> runner(TeleDartMessage message) {
    final telegram = getIt.get<Telegram>();

    final text = message.text.replaceAll('/$trigger', '');

    if (message.reply_to_message?.message_id != null) {
      telegram.sendMessage(message.chat.id, text,
          reply_to_message_id: message.reply_to_message.message_id);
    } else {
      message.reply(text);
    }

    telegram.deleteMessage(message.chat.id, message.message_id);

    return Future(() {});
  }

  @override
  String trigger = 'jt';

  @override
  TriggerMode triggerMode = TriggerMode.COMMAND;
}
