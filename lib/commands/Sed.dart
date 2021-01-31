import 'package:surake/interfaces/ICommand.dart';
import 'package:surake/utils/ExpressionParser.dart';
import 'package:teledart/src/teledart/model/message.dart';
import 'package:teledart/telegram.dart';
import 'package:surake/extensions/TeleDartMessage.dart';

import '../main.dart';

class Sed implements ICommand {
  @override
  String trigger = 's/';

  @override
  TriggerMode triggerMode = TriggerMode.TEXT;

  @override
  Future<void> runner(TeleDartMessage message) async {
    if (message.reply_to_message?.message_id == null) return;
    final telegram = getIt.get<Telegram>();

    final parser = ExpressionParser(
        expression: message.text, text: message.reply_to_message.text);

    if (!parser.isValid() || parser.result.isEmpty) return;

    if (parser.deleteSource) {
      try {
        telegram.deleteMessage(message.chat.id, message.message_id);
      } catch (err) {
        message.replyMessage("i cant delete your message.");
      }
    }

    return telegram.sendMessage(message.chat.id, parser.result,
        reply_to_message_id: message.reply_to_message.message_id);
  }
}
