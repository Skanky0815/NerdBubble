class ProductDto {
  final String id;
  final String name;
  final String img;
  final String link;

  const ProductDto(this.id, this.name, this.img, this.link);

  ProductDto.fromJson(Map<String, dynamic> json):
      id = json['id'],
      name = json['name'],
      img = json['img'],
      link = json['link'];
}