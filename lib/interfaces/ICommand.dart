import 'package:teledart/model.dart';

enum TriggerMode { COMMAND, TEXT }

abstract class ICommand {
  TriggerMode triggerMode;
  String trigger;
  Future<void> runner(TeleDartMessage message);
}
