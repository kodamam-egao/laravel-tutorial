FROM mysql/mysql-server:8.0

ENV TZ=Asia/Tokyo

COPY ./infra/mysql/my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf