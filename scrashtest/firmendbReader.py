from scrashtest.company import Company
from scrashtest.model import CompanyEntity, Base

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

class FirmendbReader(object):
    @classmethod
    def from_crawler(cls, crawler):
        settings = crawler.settings
        return cls(settings)

    def __init__(self, settings):
        database_ip = settings.get('DATABASE_IP')
        database_user = settings.get('DATABASE_USER')
        database_password = settings.get('DATABASE_PASSWORD')
        database_name = settings.get('DATABASE_NAME')

        self.mysql_engine = create_engine('mysql+pymysql://{}:{}@{}/{}?charset=utf8&use_unicode=0'
                                          .format(database_user, database_password, database_ip, database_name),
                                          pool_recycle=3600)

        # create Databases if anything is missing
        Base.metadata.create_all(self.mysql_engine)

        # create configured 'Session' class
        session_class = sessionmaker(bind=self.mysql_engine)

        # create session
        self.session = session_class()

    companies = [];

    def readSomeCompanies(self):
        query = self.session.query(CompanyEntity)\
            .order_by(CompanyEntity.id)\
            .filter(CompanyEntity.history_id == 1)\
            .filter(CompanyEntity.website != "")\
            [1:50]

        self.createExampleCompanies();

        for company in query:
            print(company.name, company.website)
            self.companies.append(Company(company.id, company.name.decode("utf-8") , company.website.decode("utf-8") ));

        return self.companies

    def createExampleCompanies(self):
        self.companies.append(Company(1, "McDonalds", "https://www.mcdonalds.de/"));
        self.companies.append(Company(2, "H. Schröer-Dreesmann e.K.", "www.schroer-dreesmann.de"));
        self.companies.append(Company(3, "Dr. Starke Chemische Industrie + Mineralöl GmbH", "www.dr-starke.eu"));
        self.companies.append(Company(4, "Goodies Messegesellschaft Ankum GmbH + Co. KG", "www.gmga.de"));
        self.companies.append(Company(5, "AMV Vertriebs GmbH", "www.amv-eu.de"));
        self.companies.append(Company(6, "IHANOJU Deutschland UG", "www.hanoju-shop.de"));
        self.companies.append(Company(7, "J. B. Holding GmbH", "www.medienpark-pfotenhauer.de"));
        self.companies.append(Company(8, "Pferdeklinik Ankum GmbH", "www.pferdepraxis-tietje.de"));
