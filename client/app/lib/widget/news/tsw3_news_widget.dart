import 'package:app/model/news_dto.dart';
import 'package:app/widget/news/date_widget.dart';
import 'package:app/widget/news/title_widget.dart';
import 'package:flutter/material.dart';

class TSW3NewsWidget extends StatelessWidget {
  final NewsDto newsDto;

  const TSW3NewsWidget({super.key, required this.newsDto});

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
              Image.network(newsDto.img),
              Positioned(
                  top: 0,
                  child: DateWidget(date: newsDto.date)
              ),
              Column(
                children: [
                  // margin: const EdgeInsets.only(top: 105),
                  TitleWidget(title:  newsDto.title),
                  Container(
                    margin: const EdgeInsets.only(top: 10),
                    child: ColoredBox(
                      color: const Color.fromRGBO(0, 0, 0, 0.5),
                      child: Container(
                        margin: const EdgeInsets.symmetric(vertical: 5.0, horizontal: 10.0),
                        child: SizedBox(
                          width: double.infinity,
                          child: Text(
                            newsDto.description!,
                            style: const TextStyle(
                                color: Color.fromRGBO(255, 255, 255, 1)
                            ),
                          ),
                        ),
                      ),
                    ),
                  )
                ]
              ),
            ],
          ),
        ],
      ),
    );
  }
}