from scrashtest.CompanyItem import CompanyItem

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

from scrashtest.model import CareerSiteEntity


class DBPipeline(object):
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

        # create configured 'Session' class
        session_class = sessionmaker(bind=self.mysql_engine)

        # create session
        self.session = session_class()


    def process_item(self, item, spider):
        assert isinstance(item, CompanyItem)

        for site in item['careerSites']:
            career_site = CareerSiteEntity(
                company_id=item['id'],
                website=site
            )
            # persist career site entity in database
            try:
                self.session.add(career_site)
                self.session.commit()
            except Exception as e:
                print(e)
                self.session.rollback()
                raise

        return item


class DefaultValuesPipeline(object):
    def process_item(self, item, spider):
        item.setdefault('name', None)
        item.setdefault('id', None)
        item.setdefault('start_url', None)
        item.setdefault('last_updated', None)
        item.setdefault('careerSites', None)
        print(item)
        return item
