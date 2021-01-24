import 'dart:async';

import 'package:surake/main.dart' as surake;

void main(List<String> arguments, {runSetup = true}) {
  if (runSetup) surake.setup();

  surake.run();

  // runZonedGuarded(surake.run, (err, stack) async {
  //   print(err);
  //   surake.stop();
  //   print("BOT CRASHED, WILL BE RESTARTED IN 10 SECONDS");
  //   await Future.delayed(Duration(seconds: 10), () {
  //     main([], runSetup: false);
  //   });
  // });
}
