from urllib.parse import urlparse


class Company(object):

    def __init__(self, id, name, url):
        self.id = id;
        self.name = name;
        if url.find("http") == -1:
            self.url = "http://" + url;
        else:
            self.url = url;
        self.domain = urlparse(self.url).netloc;
        if (not self.domain):
            self.domain = url;
