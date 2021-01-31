import 'package:teledart/model.dart';
import 'package:teledart/telegram.dart';

import '../main.dart';

extension TeleDartMessageExtension on TeleDartMessage {
  Future<Message> editMessage(String text, Message reference) {
    final telegram = getIt.get<Telegram>();

    if (reference?.message_id != null) {
      return telegram.editMessageText(text,
          message_id: reference.message_id, chat_id: reference.chat.id);
    }

    return reply(text);
  }

  Future<Message> replyMessage(String text) {
    final telegram = getIt.get<Telegram>();

    if (reply_to_message?.message_id != null) {
      return telegram.sendMessage(
        chat.id,
        text,
        reply_to_message_id: reply_to_message.message_id,
      );
    }

    return telegram.sendMessage(chat.id, text);
  }
}
