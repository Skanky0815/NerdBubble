import 'package:flutter/material.dart';

class ContentText extends StatelessWidget {
  final String content;

  const ContentText({super.key, required this.content});

  @override
  Widget build(BuildContext context) {
    return Container(
      alignment: Alignment.topLeft,
      padding: const EdgeInsets.all(10),
      child: Text(
          content
      ),
    );
  }
}
