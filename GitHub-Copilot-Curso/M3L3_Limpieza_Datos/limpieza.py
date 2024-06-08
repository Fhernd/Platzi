import pandas as pd

# Cargamos el dataset. Puede ser uno que se encuentre online:

# url = 'https://raw.githubusercontent.com/plotly/datasets/master/diabetes.csv'
df = pd.read_csv(url)


# Crea una función que reciba un DataFrame y elimine las filas duplicadas:
def eliminar_duplicados(df):
    df = df.drop_duplicates()
    return df


# Crea una función que reciba un DataFrame y elimine las filas con valores nulos:
def eliminar_nulos(df):
    df = df.dropna()
    return df


# Crea una función que reciba un DataFrame y elimine las filas con valores nulos en una columna específica:
def eliminar_nulos_columna(df, columna):
    df = df.dropna(subset=[columna])
    return df


# Función para cambiar valores lógicos por Sí y No:
def cambiar_valores(df, columna):
    df[columna] = df[columna].replace({1: 'Sí', 0: 'No'})
    return df


# Función cambiar el formato de una las columnas fecha regional de Colombia:
def cambiar_fecha(df, columna):
    df[columna] = pd.to_datetime(df[columna], format='%d/%m/%Y')
    return df


# Llama a las funciones:
df = eliminar_duplicados(df)
df = eliminar_nulos(df)
df = eliminar_nulos_columna(df, 'Glucose')
df = cambiar_valores(df, 'Outcome')
df = cambiar_fecha(df, 'Date')
