import 'package:app/model/news_dto.dart';
import 'package:app/widget/news/date_widget.dart';
import 'package:flutter/material.dart';

class XboxDynastyNewsWidget extends StatelessWidget {
  final NewsDto newsDto;

  const XboxDynastyNewsWidget({super.key, required this.newsDto});

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 10.0, horizontal: 20.0),
      clipBehavior: Clip.antiAliasWithSaveLayer,
      semanticContainer: true,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.start,
              children: <Widget>[
                DateWidget(date: newsDto.date),
                Container(
                  margin: const EdgeInsets.only(top: 10, left: 5, right: 5),
                  child: Text(
                    newsDto.title,
                    style: const TextStyle(
                      color: Colors.grey,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ],
            ),
          ),
          Image.network(newsDto.img),
        ],
      )
    );
  }
}
