import 'package:flutter/material.dart';

class DateWidget extends StatelessWidget {
  final String date;

  const DateWidget({super.key, required this.date});

  @override
  Widget build(BuildContext context) {
    return ColoredBox(
      color: const Color.fromRGBO(0, 0, 0, 0.5),
      child: Container(
        margin: const EdgeInsets.symmetric(vertical: 5.0, horizontal: 10.0),
        child: Text(
          date,
          style: const TextStyle(
            color: Color.fromRGBO(255, 255, 255, 1),
          ),
        ),
      ),
    );
  }
}
