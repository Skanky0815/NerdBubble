import 'package:app/model/news_dto.dart';
import 'package:app/model/news_type_dto.dart';
import 'package:app/service/news.dart';
import 'package:app/widget/news.dart';
import 'package:app/widget/news/fantasyflightgames_news.widget.dart';
import 'package:app/widget/news/tsw3_news_widget.dart';
import 'package:app/widget/news/xboxdynasty_news_widget.dart';
import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher_string.dart';


class NewsPage extends StatefulWidget {
  const NewsPage({super.key, required this.title});

  final String title;
  static final Map<NewsTypeDto, Function> newsWidgets = {
    NewsTypeDto.fantasyFlightGames: (NewsDto newsDto) => FantasyFlightGamesNewsWidget(newsDto: newsDto),
    NewsTypeDto.xboxDynasty: (NewsDto newsDto) => XboxDynastyNewsWidget(newsDto: newsDto),
    NewsTypeDto.tsw3: (NewsDto newsDto) => TSW3NewsWidget(newsDto: newsDto),
    NewsTypeDto.blueBrixx: (NewsDto newsDto) => NewsWidget(newsDto: newsDto),
    NewsTypeDto.fShop: (NewsDto newsDto) => NewsWidget(newsDto: newsDto),
    NewsTypeDto.ulissesSpiele: (NewsDto newsDto) => NewsWidget(newsDto: newsDto),
    NewsTypeDto.asmodee: (NewsDto newsDto) => NewsWidget(newsDto: newsDto),
    NewsTypeDto.railSim: (NewsDto newsDto) => NewsWidget(newsDto: newsDto),
  };

  @override
  State<NewsPage> createState() => _NewsPageState();
}

class _NewsPageState extends State<NewsPage> {
  final News newsService = News();

  List<NewsDto> newsList = [];
  List<String> tagList = [];
  var isLoading = true;

  @override
  void initState() {
    super.initState();

    fetchAll();
  }

  Future<void> fetchAll() async {
    final response = await newsService.fetchAll();

    setState(() {
      newsList = response['news'].map((newsJson) => NewsDto.fromJson(newsJson)).toList().cast<NewsDto>();
      tagList = response['tags'].cast<String>();
      isLoading = false;
    });

    return Future<void>.value(null);
  }

  void openUrl(NewsDto newsDto) async {
    final urlLaunchable = await canLaunchUrlString(newsDto.link);
    if (urlLaunchable) {
      await launchUrlString(newsDto.link);
    } else {
      print("URL '${newsDto.link}' can't be launched.\n");
    }
  }

  Widget content() {
    if (isLoading) {
      return Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          const CircularProgressIndicator(),
          Container(
            margin: const EdgeInsets.only(top: 10),
            child: const Text('Es Lädt...!!!'),
          ),
        ],
      );
    } else {
      return Container(
        color: Colors.white60,
        child: RefreshIndicator(
          onRefresh: fetchAll,
          child: ListView(
            children: newsList.map((newsDto) => GestureDetector(
              onTap: () {
                openUrl(newsDto);
              },
              child: NewsPage.newsWidgets[newsDto.newsTypeDto]!(newsDto)),
            ).cast<Widget>().toList(),
          ),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.title),
      ),
      body: Center(
        child: content(),
      ),
    );
  }
}