import 'package:app/model/news_dto.dart';
import 'package:app/widget/news/date_widget.dart';
import 'package:app/widget/news/title_widget.dart';
import 'package:flutter/material.dart';

class FantasyFlightGamesNewsWidget extends StatelessWidget {
  final NewsDto newsDto;

  const FantasyFlightGamesNewsWidget({super.key, required this.newsDto});

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 10.0, horizontal: 20.0),
      clipBehavior: Clip.antiAliasWithSaveLayer,
      semanticContainer: true,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Column(
        children: <Widget>[
          Stack(
            alignment: Alignment.bottomLeft,
            children: [
              Image.network(newsDto.img, ),
              Positioned(
                  top: 0,
                  child: DateWidget(date: newsDto.date)
              ),
              TitleWidget(title:  newsDto.title),
            ],
          ),
        ],
      ),
    );
  }
}
