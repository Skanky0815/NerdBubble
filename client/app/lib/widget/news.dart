import 'package:app/model/news_dto.dart';
import 'package:app/widget/news/content_text.dart';
import 'package:app/widget/news/date_widget.dart';
import 'package:app/widget/news/title_widget.dart';
import 'package:flutter/material.dart';

class NewsWidget extends StatelessWidget {
  const NewsWidget({super.key, required this.newsDto});

  final NewsDto newsDto;

  List<Widget> buildProducts(BuildContext context) {
    return newsDto.products.map((productDto) {
      return Card(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            ListTile(
              title: Text(productDto.name),
              dense: true,
            ),
            Container(
              alignment: Alignment.topCenter,
              child: FittedBox(
                child: Image.network(
                    productDto.img,
                    height: 250,
                    width: MediaQuery.of(context).size.width,
                    fit: BoxFit.scaleDown
                ),
              ),
            ),
          ],
        ),
      );
    }).toList();
  }

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(
          vertical: 10.0,
          horizontal: 20.0
      ),
      clipBehavior: Clip.antiAliasWithSaveLayer,
      semanticContainer: true,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Column(
        children: <Widget>[
          Stack(
            children: [
              Image.network(newsDto.img),
              DateWidget(date: newsDto.date),
            ],
          ),
          Container(
            margin: const EdgeInsets.only(top: 10),
            child: TitleWidget(title:  newsDto.title),
          ),
          if (newsDto.subTitle != null) ContentText(content: newsDto.subTitle!),
          if (newsDto.description != null) ContentText(content: newsDto.description!),
          if (newsDto.products.isNotEmpty) GridView.count(
            physics: const NeverScrollableScrollPhysics(),
            shrinkWrap: true,
            crossAxisCount: 2,
            children: buildProducts(context),
          ),
        ],
      ),
    );
  }
}