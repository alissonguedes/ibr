create database ibr_site;
create database ibr_laravel;

create user 'ibr'@'localhost' identified by 'vRlp0rmr07FN3SA';
grant all on ibr_laravel.* to 'ibr'@'localhost';
grant all on ibr_site.* to 'ibr'@'localhost';
