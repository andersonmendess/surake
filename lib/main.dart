import 'dart:io' show Platform;
import 'package:surake/commands.dart';
import 'package:surake/interfaces/ICommand.dart';
import 'package:teledart/teledart.dart';
import 'package:teledart/telegram.dart';
import 'package:get_it/get_it.dart';

final getIt = GetIt.instance;

void run() {
  final envVars = Platform.environment;

  if (!envVars.containsKey('BOT_TOKEN')) {
    throw Exception('BOT_TOKEN VAR IS REQUIRED');
  }

  var telegram = Telegram(envVars['BOT_TOKEN']);
  var teledart = TeleDart(telegram, Event());

  getIt.registerSingleton<Telegram>(telegram);
  getIt.registerSingleton<TeleDart>(teledart);

  teledart.start().then((me) => print('BOT IS UP'));

  commands.forEach((command) {
    if (command.triggerMode == TriggerMode.COMMAND) {
      teledart.onCommand(command.trigger).listen(command.runner);
    }

    if (command.triggerMode == TriggerMode.TEXT) {
      teledart.onMessage(keyword: command.trigger).listen(command.runner);
    }
  });
}
