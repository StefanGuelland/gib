from scrapy import cmdline
from scrashtest.firmendbReader import FirmendbReader
from scrapy.crawler import CrawlerProcess
from scrapy.utils.project import get_project_settings

fbreader = FirmendbReader(get_project_settings())
companies = fbreader.readSomeCompanies()

process = CrawlerProcess(get_project_settings())

for company in companies:
    print(company.name + ' start')
    process.crawl('careerSites', input='inputargument', id=company.id, url=company.url, domain=company.domain)
    print(company.name + ' ready')

process.start()
