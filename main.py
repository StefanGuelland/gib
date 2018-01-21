from scrapy import cmdline
from scrashtest.firmendbReader import FirmendbReader
from scrapy.crawler import CrawlerProcess
from scrapy.utils.project import get_project_settings

url = "https://www.mcdonalds.de/";
domain = "mcdonalds.de";

fbreader = FirmendbReader();
companies = fbreader.readSomeCompanies();

process = CrawlerProcess(get_project_settings());

for company in companies:
    print(company.url + 'test');
    process.crawl('quotes', input='inputargument', url=company.url, domain=company.domain);
    #  cmdline.execute(("scrapy crawl quotes -a url="+company.url+" -a domain="+company.domain).split());
    print(company.name);

process.start();
