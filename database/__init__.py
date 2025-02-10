#
# mysql wraper - functions to execute mysql commands
# Copyright (C) 2024 Dylan Ferrow
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.
#


import os


class DataBace:
    def __init__(self, database, type="postgres", host="localhost", port="5432", user=None, password=None):
        if type == "postgres":
            try:
                import psycopg2
            except ImportError as e:
                print("Failed to import psycopg2")
                raise ImportError(
                    "psycopg2 module is not installed. Please install it to use PostgreSQL.") from e
            try:
                self.mydb = psycopg2.connect(
                    host=host,
                    user=os.getenv("DB_USER") if user is None else user,
                    password=os.getenv(
                        "DB_PASSWORD") if password is None else password,
                    database=database,
                    port=port
                )
                self.cursor = self.mydb.cursor()
            except psycopg2.errors.OperationalError as e:
                print("Failed to connect to database")
                raise psycopg2.errors.OperationalError(
                    "Failed to connect to database. Check if the database exists and the credentials are correct.") from e
        else:
            try:
                import mysql.connector
            except ImportError as e:
                print("Failed to import mysql.connector")
                raise ImportError(
                    "mysql.connector module is not installed. Please install it to use MySQL.") from e
            try:
                self.mydb = mysql.connector.connect(
                    host=host,
                    user=os.getenv("DB_USER") if user is None else user,
                    password=os.getenv(
                        "DB_PASSWORD") if password is None else password,
                    database=database,
                    port=port if port != "5432" else "3306"
                )
                self.cursor = self.mydb.cursor()
            except mysql.connector.errors.InterfaceError as e:
                print("Failed to connect to database")
                # raise mysql.connector.errors.ProgrammingError(
                #     "Failed to connect to database. Check if the database exists and the credentials are correct.") from e

    def setup(self, file: str):
        if not os.path.exists(file):
            return "File does not exist"
        if not file.endswith(".sql"):
            return "File is not a sql file"
        with open(file, "r") as f:
            try:
                self.cursor.execute(f.read())
            except Exception as e:
                return f"Failed to create table: {e}"
        self.mydb.commit()
        return "Tables created successfully"

    def setup(self, files: list):
        error = "Failed to create table: "
        for file in files:
            if not os.path.exists(file):
                return f"File {file} does not exist"
            if not file.endswith(".sql"):
                return f"File {file} is not a sql file"
            with open(file, "r") as f:
                try:
                    self.cursor.execute(f.read())
                except Exception as e:
                    error += str(e)
        self.mydb.commit()
        return error if error == "Failed to create table: " else "Tables created successfully"

    def DBExists(self, name: str):
        self.cursor.execute("SHOW DATABASES")
        for x in self.cursor.fetchall():
            if x[0] == name:
                return True
        return False

    def createDB(self, name: str):
        self.cursor.execute(f"CREATE DATABASE {name}")

    def selectDB(self, name: str):
        self.cursor.execute(f"USE {name}")

    def createTable(self, name: str, values: str):
        self.cursor.execute(f"CREATE TABLE {name} {values}")

    def tableExists(self, name: str):
        self.cursor.execute("SHOW TABLES")
        tables = self.cursor.fetchall()
        for x in tables:
            if x[0] == name:
                return True
        return False

    def insert(self, table: str, values: tuple, columns: list):
        columns = str(columns).replace(
            "'", '').replace("[", "").replace("]", "")
        sql = f"INSERT INTO {table} {columns} VALUES ("
        for i in range(len(columns.split(","))):
            if i == len(columns.split(",")) - 1:
                sql += "%s)"
            else:
                sql += "%s,"
        print(sql)
        self.cursor.execute(sql, values)
        self.mydb.commit()

    def insertMultiple(self, table: str, values: list, columns: list):
        columns = str(columns).replace(
            "'", '').replace("[", "").replace("]", "")
        sql = f"INSERT INTO {table} ({columns}) VALUES ("
        for i in range(len(columns.split(","))):
            if i == len(columns.split(",")) - 1:
                sql += "%s)"
            else:
                sql += "%s,"
        self.cursor.executemany(sql, values)
        self.mydb.commit()

    def update(self, table: str, value: str, condition: str):
        self.cursor.execute(f"UPDATE {table} SET {value} WHERE {condition}")
        self.mydb.commit()

    def insertColoum(self, table: str, column_name: str, column_type: str):
        self.cursor.execute(
            f"ALTER TABLE {table} ADD COLUMN {column_name} {column_type}")
        self.mydb.commit()

    def select(self, table: str, values: str, condition: str = None):
        if condition is None:
            self.cursor.execute(f"SELECT {values} FROM {table}")
        else:
            self.cursor.execute(
                f"SELECT {values} FROM {table} WHERE {condition}")
        return self.cursor.fetchall()

    def delete(self, table: str, condition: str):
        self.cursor.execute(f"DELETE FROM {table} WHERE {condition}")
        self.mydb.commit()

    def close(self):
        self.cursor.close()
        self.mydb.close()
