from scrashtest.CompanyItem import CompanyItem


class DBPipeline(object):
    #  def __init__(self, settings):
    # ...  DB Session ...

    def process_item(self, item, spider):
        assert isinstance(item, CompanyItem)
        print(item)
        # in DB speichern

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
