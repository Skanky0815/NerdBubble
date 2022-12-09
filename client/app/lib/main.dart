import 'package:app/page/news_page.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My Games',
      theme: ThemeData(
        primarySwatch: Colors.orange,
        backgroundColor: Colors.grey
      ),
      home: const NewsPage(title: 'News!'),
    );
  }
}
