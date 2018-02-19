
SET OUT=..\output\products.all.sql

type ..\tables\*.sql > %OUT%

type ..\seeds\*.sql >> %OUT%