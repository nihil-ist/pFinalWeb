import tkinter as tk
from tkinter import ttk
import cmath
import math
import sys
import matplotlib.pyplot as plt
from matplotlib.patches import Arc
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
from ttkthemes import ThemedStyle

global coordenadas_rectangulares
coordenadas_rectangulares = True
global rReal,rImag,rMagnitud,rAngulo
rReal=rImag=rMagnitud=rAngulo=0.0
def graficar_rectangular(r, c, ventana):
    real = r
    imaginario = c
    magnitud = math.sqrt(real**2 + imaginario**2)
    
    if real != 0:
        angulo = math.degrees(math.atan(imaginario/real))
    else:
        angulo = 90 if imaginario > 0 else -90
    if real<0 and imaginario<0:
        angulo=angulo-180
    if real<0 and imaginario>0:
        angulo=angulo+180

    fig, ax = plt.subplots()

    ax.scatter(real, imaginario, color='blue', marker='o')

    ax.plot([0, real], [0, imaginario], color='red', linestyle='--')

    if angulo > 0:
        arc = Arc((0, 0), magnitud * 2, magnitud * 2, theta1=0, theta2=angulo, color='green')
    else:
        arc = Arc((0, 0), magnitud * 2, magnitud * 2, theta1=angulo, theta2=0, color='green')
    ax.add_patch(arc)

    ax.axhline(0, color='black', linewidth=0.5)
    ax.axvline(0, color='black', linewidth=0.5)

    ax.set_title(f'Número complejo rectangular\nReal: {real:.2f}, Imaginario: {imaginario:.2f}, Magnitud: {magnitud:.2f}, Angulo: {angulo:.2f}')
    ax.set_xlabel('Parte Real')
    ax.set_ylabel('Parte Imaginaria')

    ax.grid(True)

    ax.set_xlim(-magnitud * 1.5, magnitud * 1.5)
    ax.set_ylim(-magnitud * 1.5, magnitud * 1.5)

    canvas = FigureCanvasTkAgg(fig, master=ventana)
    canvas_widget = canvas.get_tk_widget()
    canvas_widget.grid(row=14, column=0, columnspan=3, pady=5)


def graficar_polar(pM, pA, ventana):
    if pM<0:
        pM = -pM
    real = pM * math.cos(math.radians(pA))
    imaginario = pM * math.sin(math.radians(pA))
    if pA>180:
        pA=pA-360
    if pA<-180:
        pA = pA+360

    fig, ax = plt.subplots()

    ax.scatter(real, imaginario, color='blue', marker='o')

    ax.plot([0, real], [0, imaginario], color='red', linestyle='--')

    if pA > 0:
        arc = Arc((0, 0), pM * 2, pM * 2, theta1=0, theta2=pA, color='green')
    else:
        arc = Arc((0, 0), pM * 2, pM * 2, theta1=pA, theta2=0, color='green')
    ax.add_patch(arc)

    ax.axhline(0, color='black', linewidth=0.5)
    ax.axvline(0, color='black', linewidth=0.5)

    ax.set_title(f'Número complejo polar\n Real: {real:.2f}, Imaginario: {imaginario:.2f}, Magnitud: {pM:.2f}, Angulo: {pA:.2f}')
    ax.set_xlabel('Parte Real')
    ax.set_ylabel('Parte Imaginaria')

    ax.grid(True)

    ax.set_xlim(-pM * 1.5, pM * 1.5)
    ax.set_ylim(-pM * 1.5, pM * 1.5)

    canvas = FigureCanvasTkAgg(fig, master=ventana)
    canvas_widget = canvas.get_tk_widget()
    canvas_widget.grid(row=14, column=0, columnspan=3, pady=5)


def operaciones_numeros_complejos(r1, c1,r2,c2, operacion):
    global coordenadas_rectangulares
    resultado = [0, 0]
    if coordenadas_rectangulares: #real1,imag1,real2,imag2
        if operacion == 'Suma':
            resultado[0] = r1+r2
            resultado[1] = c1+c2
        elif operacion == 'Resta':
            resultado[0] = r1-r2
            resultado[1] = c1-c2
        elif operacion == 'Multiplicacion':
            magnitud1 = math.sqrt(r1**2 + c1**2)
            magnitud2 = math.sqrt(r2**2 + c2**2)
            angulo1 = math.degrees(math.atan(c1/r1))
            angulo2 = math.degrees(math.atan(c2/r2))
            resultado[0] = magnitud1*magnitud2
            resultado[1] = angulo1+angulo2
        elif operacion == 'Division':
            magnitud1 = math.sqrt(r1**2 + c1**2)
            magnitud2 = math.sqrt(r2**2 + c2**2)
            angulo1 = math.degrees(math.atan(c1/r1))
            angulo2 = math.degrees(math.atan(c2/r2))
            resultado[0] = magnitud1/magnitud2
            resultado[1] = angulo1-angulo2
        else:
            resultado = 0
    else: #magnitud1,angulo1,magnitud2,angulo2
        if operacion == 'Suma':
            real1 = r1 * math.cos(math.radians(c1))
            imaginario1 = r1 * math.sin(math.radians(c1))
            real2 = r2 * math.cos(math.radians(c2))
            imaginario2 = r2 * math.sin(math.radians(c2))
            resultado[0] = real1+real2
            resultado[1] = imaginario1+imaginario2
        elif operacion == 'Resta':
            real1 = r1 * math.cos(math.radians(c1))
            imaginario1 = r1 * math.sin(math.radians(c1))
            real2 = r2 * math.cos(math.radians(c2))
            imaginario2 = r2 * math.sin(math.radians(c2))
            resultado[0] = real1-real2
            resultado[1] = imaginario1-imaginario2
        elif operacion == 'Multiplicacion':
            resultado[0] = r1*r2
            resultado[1] = c1+c2
        elif operacion == 'Division':
            resultado[0] = r1/r2
            resultado[1] = c1-c2
        else:
            resultado = 0

    return resultado

def alternar_coordenadas():
    global coordenadas_rectangulares
    if coordenadas_rectangulares:
        coordenadas_rectangulares = False
    else:
        coordenadas_rectangulares = True

def open_calculator():
    global coordenadas_rectangulares,rReal,rImag,rMagnitud,rAngulo
    calculator_window = tk.Toplevel(root)
    style = ThemedStyle(calculator_window)
    style.set_theme("arc")
    
    if coordenadas_rectangulares:
        calculator_window.title("Calculadora introduciendo en  forma rectangular")
        calculator_window.configure(bg=style.lookup("TFrame", "background"))
        calculator_window.option_add("*TButton*highlightThickness", 0)

        num1_label = ttk.Label(calculator_window, text="Número 1:")
        rectangularR1_label = ttk.Label(calculator_window, text="Parte real:")
        rectangularC1_label = ttk.Label(calculator_window, text="Parte imaginaria:")
        rectangularReal1 = ttk.Entry(calculator_window)
        rectangularComplejo1 = ttk.Entry(calculator_window)

        num2_label = ttk.Label(calculator_window, text="Número 2:")
        rectangularR2_label = ttk.Label(calculator_window, text="Parte real:")
        rectangularC2_label = ttk.Label(calculator_window, text="Parte imaginaria:")
        rectangularReal2 = ttk.Entry(calculator_window)
        rectangularComplejo2 = ttk.Entry(calculator_window)
        operacion_label = ttk.Label(calculator_window, text="Operación:")
        operacion_combobox = ttk.Combobox(calculator_window, values=["Suma", "Resta", "Multiplicacion", "Division"])
        operacion_combobox.set("Suma")

        result_label = ttk.Label(calculator_window, text="Resultado:")

        calcular_button = ttk.Button(calculator_window, text="Calcular", command=lambda: show_result())

        def show_result():
            resultado = operaciones_numeros_complejos(
                float(rectangularReal1.get()), 
                float(rectangularComplejo1.get()),
                float(rectangularReal2.get()),
                float(rectangularComplejo2.get()),
                operacion_combobox.get()
            )
            if operacion_combobox.get() == 'Suma' or operacion_combobox.get() == 'Resta':
                rReal = resultado[0]
                rImag = resultado[1]
                rMagnitud = math.sqrt(rReal**2 + rImag**2)
                if rReal != 0:
                    rAngulo = math.degrees(math.atan(rImag/rReal))
                else:
                    rAngulo = 90 if rImag > 0 else -90
                if rImag>=0:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} + j{rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                else:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} - j{-rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                graficar_rectangular(float(rReal),float(rImag), calculator_window)
            else: #multiplicacion y division
                rMagnitud = resultado[0]
                rAngulo = resultado[1]
                rReal = rMagnitud * math.cos(math.radians(rAngulo))
                rImag = rMagnitud * math.sin(math.radians(rAngulo))
                if rImag>=0:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} + j{rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                else:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} - j{-rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                graficar_rectangular(float(rReal),float(rImag), calculator_window)
        volver_button = ttk.Button(calculator_window, text="Volver",
                                command=lambda: [calculator_window.destroy(), root.deiconify()])

        num1_label.grid(row=2, column=1, pady=5, padx=20)
        rectangularR1_label.grid(row=3, column=0, pady=5, padx=20)
        rectangularC1_label.grid(row=3, column=2, pady=5, padx=20)
        rectangularReal1.grid(row=4, column=0, pady=5, padx=20)
        rectangularComplejo1.grid(row=4, column=2, pady=5, padx=20)

        num2_label.grid(row=5, column=1, pady=5, padx=20)
        rectangularR2_label.grid(row=6, column=0, pady=5, padx=20)
        rectangularC2_label.grid(row=6, column=2, pady=5, padx=20)
        rectangularReal2.grid(row=7, column=0, pady=5, padx=20)
        rectangularComplejo2.grid(row=7, column=2, pady=5, padx=20)

        operacion_label.grid(row=8, column=0, pady=5, padx=20)
        operacion_combobox.grid(row=8, column=1, pady=5, padx=20)

        calcular_button.grid(row=8, column=2, columnspan=2, pady=5, padx=20)
        result_label.grid(row=10, column=0, columnspan=3, pady=5, padx=20)

        cambiar_button = ttk.Button(calculator_window, text="Cambiar a polares",
                                command=lambda: [alternar_coordenadas(),calculator_window.destroy(),open_calculator()])
        cambiar_button.grid(row=11, column=1, pady=5, padx=20)
        volver_button.grid(row=12, column=1, pady=5, padx=20)
    else:
        calculator_window.title("Calculadora introduciendo en  forma polar")
        calculator_window.configure(bg=style.lookup("TFrame", "background"))
        calculator_window.option_add("*TButton*highlightThickness", 0)

        num1_label = ttk.Label(calculator_window, text="Número 1:")
        M1_label = ttk.Label(calculator_window, text="Magnitud:")
        A1_label = ttk.Label(calculator_window, text="Angulo:")
        M1 = ttk.Entry(calculator_window)
        A1 = ttk.Entry(calculator_window)

        num2_label = ttk.Label(calculator_window, text="Número 2:")
        M2_label = ttk.Label(calculator_window, text="Magnitud:")
        A2_label = ttk.Label(calculator_window, text="Angulo:")
        M2 = ttk.Entry(calculator_window)
        A2 = ttk.Entry(calculator_window)
        operacion_label = ttk.Label(calculator_window, text="Operación:")
        operacion_combobox = ttk.Combobox(calculator_window, values=["Suma", "Resta", "Multiplicacion", "Division"])
        operacion_combobox.set("Suma")

        result_label = ttk.Label(calculator_window, text="Resultado:")

        calcular_button = ttk.Button(calculator_window, text="Calcular", command=lambda: show_result())

        def show_result():
            resultado = operaciones_numeros_complejos(
                float(M1.get()), 
                float(A1.get()),
                float(M2.get()),
                float(A2.get()),
                operacion_combobox.get()
            )
            if operacion_combobox.get() == 'Suma' or operacion_combobox.get() == 'Resta':
                rReal = resultado[0]
                rImag = resultado[1]
                rMagnitud = math.sqrt(rReal**2 + rImag**2)
                if rReal != 0:
                    rAngulo = math.degrees(math.atan(rImag/rReal))
                else:
                    rAngulo = 90 if rImag > 0 else -90
                if rImag>=0:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} + j{rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                else:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} - j{-rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                graficar_polar(float(rMagnitud),float(rAngulo), calculator_window)
            else: #multiplicacion y division
                rMagnitud = resultado[0]
                rAngulo = resultado[1]
                rReal = rMagnitud * math.cos(math.radians(rAngulo))
                rImag = rMagnitud * math.sin(math.radians(rAngulo))
                if rImag>=0:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} + j{rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                else:
                    result_label.config(text=f'Resultados: Rectangular: {rReal:.4f} - j{-rImag:.4f}  Polar: {rMagnitud:.4f} /_ {rAngulo:.4f}°')
                graficar_polar(float(rMagnitud),float(rAngulo), calculator_window)
        volver_button = ttk.Button(calculator_window, text="Volver",
                                command=lambda: [calculator_window.destroy(), root.deiconify()])
        num1_label.grid(row=2, column=1, pady=5, padx=20)
        M1_label.grid(row=3, column=0, pady=5, padx=20)
        A1_label.grid(row=3, column=2, pady=5, padx=20)
        M1.grid(row=4, column=0, pady=5, padx=20)
        A1.grid(row=4, column=2, pady=5, padx=20)

        num2_label.grid(row=5, column=0, pady=5, padx=20)
        M2_label.grid(row=6, column=0, pady=5, padx=20)
        A2_label.grid(row=6, column=2, pady=5, padx=20)
        M2.grid(row=7, column=0, pady=5, padx=20)
        A2.grid(row=7, column=2, pady=5, padx=20)

        operacion_label.grid(row=8, column=0, pady=5, padx=20)
        operacion_combobox.grid(row=8, column=1, pady=5, padx=20)

        calcular_button.grid(row=8, column=2, columnspan=2, pady=5, padx=20)
        result_label.grid(row=10, column=0, columnspan=3, pady=5, padx=20)

        cambiar_button = ttk.Button(calculator_window, text="Cambiar a rectangulares",
                                command=lambda: [alternar_coordenadas(),calculator_window.destroy(),open_calculator()])
        cambiar_button.grid(row=11, column=1, pady=5, padx=20)
        volver_button.grid(row=12, column=1, pady=5, padx=20)

def open_complex_graph():
    complex_graph_window = tk.Toplevel(root)
    style = ThemedStyle(complex_graph_window)
    style.set_theme("arc")

    complex_graph_window.title("Gráfica de Número Complejo")
    complex_graph_window.configure(bg=style.lookup("TFrame", "background"))
    complex_graph_window.option_add("*TButton*highlightThickness", 0)
    
    polarM_label = ttk.Label(complex_graph_window, text="Magnitud:")
    polarA_label = ttk.Label(complex_graph_window, text="Angulo:")
    polarMagnitud = ttk.Entry(complex_graph_window)
    polarAngulo = ttk.Entry(complex_graph_window)


    graficar_polar_button = ttk.Button(complex_graph_window, text="Graficar Polar",
                                   command=lambda: graficar_polar(float(polarMagnitud.get()),float(polarAngulo.get()), complex_graph_window))

    volver_button = ttk.Button(complex_graph_window, text="Volver",
                               command=lambda: [complex_graph_window.destroy(), root.deiconify()])

    polarM_label.grid(row=0, column=1, pady=5, padx=20)
    polarMagnitud.grid(row=1, column=1, pady=5, padx=20)
    polarA_label.grid(row=2, column=1, pady=5, padx=20)
    polarAngulo.grid(row=3, column=1, pady=5, padx=20)
    graficar_polar_button.grid(row=4, column=1, pady=5, padx=20)
    volver_button.grid(row=10, column=1, pady=5, padx=20)


def open_rectangular_graph():
    rectangular_graph_window = tk.Toplevel(root)
    style = ThemedStyle(rectangular_graph_window)
    style.set_theme("arc")

    rectangular_graph_window.title("Gráfica de Número Rectangular")
    rectangular_graph_window.configure(bg=style.lookup("TFrame", "background"))
    rectangular_graph_window.option_add("*TButton*highlightThickness", 0)
    
    rectangularR_label = ttk.Label(rectangular_graph_window, text="Parte real:")
    rectangularC_label = ttk.Label(rectangular_graph_window, text="Parte imaginaria:")
    rectangularReal = ttk.Entry(rectangular_graph_window)
    rectangularComplejo = ttk.Entry(rectangular_graph_window)


    graficar_rectangular_button = ttk.Button(rectangular_graph_window, text="Graficar Rectangular",
                                         command=lambda: graficar_rectangular(float(rectangularReal.get()),float(rectangularComplejo.get()), rectangular_graph_window))
    
    volver_button = ttk.Button(rectangular_graph_window, text="Volver",
                               command=lambda: [rectangular_graph_window.destroy(), root.deiconify()])
    
    rectangularR_label.grid(row=0, column=1, pady=5, padx=20)
    rectangularReal.grid(row=1, column=1, pady=5, padx=20)
    rectangularC_label.grid(row=2, column=1, pady=5, padx=20)
    rectangularComplejo.grid(row=3, column=1, pady=5, padx=20)
    graficar_rectangular_button.grid(row=4, column=1, pady=5, padx=20)
    volver_button.grid(row=10, column=1, pady=5, padx=20)


root = tk.Tk()
root.title("Menú")
style = ThemedStyle(root)
style.set_theme("arc")

root.configure(bg=style.lookup("TFrame", "background"))
root.option_add("*TButton*highlightThickness", 0)

name_label0 = ttk.Label(root, text="Proyecto Final")
name_label0.configure(font=("", 20, "bold"))
name_label0.pack(pady=10, padx=20)

name_label02 = ttk.Label(root, text="Circuitos Eléctricos")
name_label02.configure(font=("", 18, "bold"))
name_label02.pack(pady=5, padx=20)

name_label1 = ttk.Label(root, text="Alejandro Lopez Ruiz")
name_label1.configure(font=("", 14))
name_label1.pack(pady=10, padx=20)

name_label2 = ttk.Label(root, text="Angel Ivan Reyes Hernandez")
name_label2.configure(font=("", 14))
name_label2.pack(pady=10, padx=20)

name_label3 = ttk.Label(root, text="Diego Zamora Delgadillo")
name_label3.configure(font=("", 14))
name_label3.pack(pady=10, padx=20)

calculator_button = ttk.Button(root, text="Calculadora", command=lambda:[open_calculator(), root.withdraw()])
calculator_button.pack(pady=10, padx=20)

complex_graph_button = ttk.Button(root, text="Gráfica de Número Complejo", command=lambda:[open_complex_graph(), root.withdraw()])
complex_graph_button.pack(pady=10, padx=20)

rectangular_graph_button = ttk.Button(root, text="Gráfica de Número Rectangular", command=lambda:[open_rectangular_graph(), root.withdraw()])
rectangular_graph_button.pack(pady=10, padx=20)

cerrar_button = ttk.Button(root, text="Cerrar", command=sys.exit)
cerrar_button.pack(pady=10, padx=20)

root.mainloop()