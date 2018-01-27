from scrapy import cmdline
from scrashtest.firmendbReader import FirmendbReader

url = "https://www.mcdonalds.de/";
domain = "mcdonalds.de";

fbreader = FirmendbReader();
companies = fbreader.readSomeCompanies();

for company in companies:
    cmdline.execute(("scrapy crawl quotes -a id=" + company.id+ " -a url=" + company.url + " -a domain=" + company.domain).split());
    print(company.name);
