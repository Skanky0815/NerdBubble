import 'package:app/model/news_type_dto.dart';

import 'product_dto.dart';

class NewsDto {
  final String id;
  final String title;
  final String? subTitle;
  final String img;
  final String link;
  final String? description;
  final String date;
  final NewsTypeDto newsTypeDto;
  final List<ProductDto> products;
  final List<String> tags;

  const NewsDto(this.id, this.title, this.subTitle, this.img, this.link,
      this.description, this.date, this.newsTypeDto, this.products, this.tags);

  NewsDto.fromJson(Map<String, dynamic> json):
      id = json['id'],
      title = json['title'],
      subTitle = json['subTitle'],
      img = json['img'],
      link = json['link'],
      description = json['description'],
      date = json['date'],
      newsTypeDto = newsTypeFromString(json['newsType']),
      products = json['products'].map((productJson) => ProductDto.fromJson(productJson)).toList().cast<ProductDto>(),
      tags = json['tags'].cast<String>();
}