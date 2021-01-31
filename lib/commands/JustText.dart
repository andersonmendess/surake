import 'package:surake/interfaces/ICommand.dart';
import 'package:surake/main.dart';
import 'package:teledart/src/teledart/model/message.dart';
import 'package:teledart/telegram.dart';

class JustText implements ICommand {
  @override
  Future<void> runner(TeleDartMessage message) {
    final telegram = getIt.get<Telegram>();

    final text = message.text.replaceAll('/$trigger', '');

    if (text.isEmpty) return null;

    if (message.reply_to_message?.message_id != null) {
      telegram.sendMessage(message.chat.id, text,
          reply_to_message_id: message.reply_to_message.message_id);
    } else {
      message.reply(text);
    }

    try {
      telegram.deleteMessage(message.chat.id, message.message_id);
    } catch (err) {
      message.reply('I cant delete the message, please give me ademir');
    }

    return Future(() {});
  }

  @override
  String trigger = 'jt';

  @override
  TriggerMode triggerMode = TriggerMode.COMMAND;
}
