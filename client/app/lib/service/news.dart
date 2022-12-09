import 'dart:async';
import 'dart:convert';

import 'package:http/http.dart' as http;

class News {
  final Utf8Codec utf8 = const Utf8Codec();

  Future<Map<String, dynamic>> fetchAll() async {
    final url = Uri.http('0.0.0.0:8080', '/news');
    final response = await http.get(url);

    final decodedResponse = utf8.decode(response.bodyBytes);

    return (jsonDecode(decodedResponse));
  }
}