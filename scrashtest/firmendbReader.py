from scrashtest.company import Company


class FirmendbReader(object):
    companies = [];

    def readSomeCompanies(self):
        self.createExampleCompanies();
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
