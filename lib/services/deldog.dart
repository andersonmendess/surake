import 'dart:convert';

import 'package:http/http.dart' as http;

class DeldogService {
  static const baseURL = 'https://del.dog/';

  Future<String> pushContent(String content) async {
    final request =
        await http.post(baseURL + 'documents?frontend=true', body: content);

    if (request.statusCode == 200 && request.body.contains('key')) {
      return baseURL + jsonDecode(request.body)['key'];
    }

    return null;
  }
}
