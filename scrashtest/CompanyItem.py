import scrapy


class CompanyItem(scrapy.Item):
    name = scrapy.Field()
    id = scrapy.Field()
    start_url = scrapy.Field()
    last_updated = scrapy.Field(serializer=str)
    careerSites = scrapy.Field()
