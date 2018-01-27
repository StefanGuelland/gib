from sqlalchemy import Column, Integer, String, ForeignKey, func
from sqlalchemy.dialects.mysql import TIMESTAMP
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import relationship

Base = declarative_base()


class HistoryEntity(Base):
    __tablename__ = 'history'

    # attributes
    id = Column('id', Integer, primary_key=True, autoincrement=True)
    date = Column('date', TIMESTAMP)

    # object relations
    companies = relationship('CompanyEntity', back_populates='history')


class SectorEntity(Base):
    __tablename__ = 'sector'

    # attributes
    id = Column('id', Integer, primary_key=True, autoincrement=True)
    description = Column('label', String(200))

    # object relations
    companies = relationship('CompanyEntity', back_populates='sector')


class CityEntity(Base):
    __tablename__ = 'city'

    # attributes
    postal_code = Column('postal_code', Integer, primary_key=True, autoincrement=True)
    city = Column('city', String(100))

    # object relations
    companies = relationship('CompanyEntity', back_populates='city')


class LegalFormEntity(Base):
    __tablename__ = 'legal_form'

    # attributes
    id = Column('id', Integer, primary_key=True, autoincrement=True)
    legal_form = Column('label', String(100))

    # object relations
    companies = relationship('CompanyEntity', back_populates='legal_form')


class CompanyEntity(Base):
    __tablename__ = 'company'

    # attributes
    id = Column('id', Integer, primary_key=True, autoincrement=True)
    history_id = Column('history_id', Integer, ForeignKey('history.id'), primary_key=True, autoincrement=False)
    name = Column('name', String(500))
    postal_code = Column('postal_code', Integer, ForeignKey('city.postal_code'))
    address = Column('address', String(250))
    telephone = Column('telephone', String(25))
    website = Column('website', String(150))
    legal_form_id = Column('legal_form_id', Integer, ForeignKey('legal_form.id'))
    sector_id = Column('sector_id', Integer, ForeignKey('sector.id'))
    salestax_id = Column('salestax_id', String(100))
    employees = Column('employees', String(150))
    year_of_foundation = Column('year_of_foundation', Integer)

    # object relations
    history = relationship('HistoryEntity', back_populates='companies')
    city = relationship('CityEntity', back_populates='companies')
    legal_form = relationship('LegalFormEntity', back_populates='companies')
    sector = relationship('SectorEntity', back_populates='companies')

class CareerSiteEntity(Base):
    __tablename__ = 'career_site'

    # attributes
    id = Column('id', Integer, primary_key=True, autoincrement=True)
    company_id = Column('company_id', Integer, ForeignKey('company.id'))
    website = Column('website', String(150))
    timestamp = Column('timestamp', TIMESTAMP, default=func.now())


print()