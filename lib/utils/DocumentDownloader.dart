import 'package:teledart/model.dart';
import 'package:http/http.dart' as http;
import 'dart:io' show Platform;

class DocumentDownloader {
  String baseURL;

  DocumentDownloader() {
    baseURL = 'https://api.telegram.org/file/bot' +
        Platform.environment['BOT_TOKEN'] +
        '/';
  }

  Future<String> getAsString(File file) async {
    final result = await http.get(baseURL + file.file_path);

    if (result.statusCode == 200) {
      return result.body;
    }

    return null;
  }
}
