export './commands/JustText.dart';

import 'package:surake/commands/Deldog.dart';
import 'package:surake/interfaces/ICommand.dart';

import 'commands/JustText.dart';
import 'commands/Sed.dart';

final List<ICommand> commands = [
  JustText(),
  Deldog(),
  Sed(),
];
