import tkinter as tk
from tkinter import ttk
import cmath
import math
import matplotlib.pyplot as plt
from matplotlib.patches import Arc
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg

def graficar_rectangular(complejo):
    real = complejo.real
    imaginario = complejo.imag
    magnitud = abs(complejo)
    angulo = math.degrees(cmath.phase(complejo))

    # Crear la figura y el eje
    fig, ax = plt.subplots()

    # Graficar el número complejo
    ax.scatter(real, imaginario, color='blue', marker='o')

    # Graficar la línea desde el origen hasta el punto
    ax.plot([0, real], [0, imaginario], color='red', linestyle='--')

    # Graficar la sección del círculo que representa el ángulo
    arc = Arc((0, 0), magnitud * 2, magnitud * 2, theta1=0, theta2=angulo, color='green')
    ax.add_patch(arc)

    # Graficar los ejes x e y
    ax.axhline(0, color='black', linewidth=0.5)
    ax.axvline(0, color='black', linewidth=0.5)

    # Configurar etiquetas y título
    ax.set_title(f'Número complejo rectangular\nReal: {real}, Imaginario: {imaginario}')
    ax.set_xlabel('Parte Real')
    ax.set_ylabel('Parte Imaginaria')

    # Configurar el aspecto del gráfico
    ax.grid(True)

    # Ajustar la escala para incluir todos los cuadrantes
    ax.set_xlim(-magnitud * 1.5, magnitud * 1.5)
    ax.set_ylim(-magnitud * 1.5, magnitud * 1.5)

    # Mostrar la gráfica en la interfaz
    canvas = FigureCanvasTkAgg(fig, master=ventana)
    canvas_widget = canvas.get_tk_widget()
    canvas_widget.grid(row=7, column=0, columnspan=3, pady=5)

def graficar_polar(complejo):
    magnitud = abs(complejo)
    angulo = math.degrees(cmath.phase(complejo))

    # Crear la figura y el eje polar
    fig, ax = plt.subplots(subplot_kw={'projection': 'polar'})

    # Graficar el número complejo en coordenadas polares
    ax.scatter(math.radians(angulo), magnitud, color='blue', marker='o')

    # Graficar la sección del círculo que representa el ángulo
    sector_angle = 10  # Puedes ajustar este valor para cambiar el tamaño del sector del círculo
    arc = Arc((0, 0), 2 * math.pi, magnitud, theta1=0, theta2=angulo if angulo < sector_angle else sector_angle, color='green')
    ax.add_patch(arc)

    # Graficar los ejes radiales
    ax.set_rlabel_position(180)
    ax.set_yticklabels([])
    ax.set_xticklabels([])

    # Configurar el título
    ax.set_title(f'Número complejo polar\nMagnitud: {magnitud:.2f}, Ángulo: {angulo:.2f}°')

    # Ajustar la escala para incluir todos los cuadrantes
    ax.set_rmax(magnitud * 1.5)

    # Mostrar la gráfica en la interfaz
    canvas = FigureCanvasTkAgg(fig, master=ventana)
    canvas_widget = canvas.get_tk_widget()
    canvas_widget.grid(row=7, column=0, columnspan=3, pady=5)

def operaciones_numeros_complejos(num1, num2, operacion):
    complejo1 = complex(num1.get())
    complejo2 = complex(num2.get())

    if operacion == 'Suma':
        resultado = complejo1 + complejo2
    elif operacion == 'Resta':
        resultado = complejo1 - complejo2
    elif operacion == 'Multiplicacion':
        resultado = complejo1 * complejo2
    elif operacion == 'Division':
        resultado = complejo1 / complejo2
    else:
        resultado = 0

    result_label.config(text=f'Resultado: {resultado}')

# Crear la ventana principal
ventana = tk.Tk()
ventana.title("Calculadora de Números Complejos")

# Crear widgets
rectangular_label = ttk.Label(ventana, text="Número Complejo Rectangular:")
rectangular_entry = ttk.Entry(ventana)

polar_label = ttk.Label(ventana, text="Número Complejo Polar:")
polar_entry = ttk.Entry(ventana)

graficar_rectangular_button = ttk.Button(ventana, text="Graficar Rectangular",
                                         command=lambda: graficar_rectangular(complex(rectangular_entry.get())))

graficar_polar_button = ttk.Button(ventana, text="Graficar Polar",
                                   command=lambda: graficar_polar(complex(polar_entry.get())))

num1_label = ttk.Label(ventana, text="Número 1:")
num1_entry = ttk.Entry(ventana)

num2_label = ttk.Label(ventana, text="Número 2:")
num2_entry = ttk.Entry(ventana)

operacion_label = ttk.Label(ventana, text="Operación:")
operacion_combobox = ttk.Combobox(ventana, values=["Suma", "Resta", "Multiplicacion", "Division"])
operacion_combobox.set("Suma")

calcular_button = ttk.Button(ventana, text="Calcular",
                             command=lambda: operaciones_numeros_complejos(num1_entry, num2_entry, operacion_combobox.get()))

result_label = ttk.Label(ventana, text="Resultado:")

# Posicionar widgets en la ventana
rectangular_label.grid(row=0, column=0, pady=5)
rectangular_entry.grid(row=0, column=1, pady=5)
graficar_rectangular_button.grid(row=0, column=2, pady=5)

polar_label.grid(row=1, column=0, pady=5)
polar_entry.grid(row=1, column=1, pady=5)
graficar_polar_button.grid(row=1, column=2, pady=5)

num1_label.grid(row=2, column=0, pady=5)
num1_entry.grid(row=2, column=1, pady=5)

num2_label.grid(row=3, column=0, pady=5)
num2_entry.grid(row=3, column=1, pady=5)

operacion_label.grid(row=4, column=0, pady=5)
operacion_combobox.grid(row=4, column=1, pady=5)

calcular_button.grid(row=5, column=0, columnspan=2, pady=5)
result_label.grid(row=6, column=0, columnspan=2, pady=5)

ventana.mainloop()
