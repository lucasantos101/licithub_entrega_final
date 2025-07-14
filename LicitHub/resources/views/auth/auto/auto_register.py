from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time # Mantido para demonstração de sleep

# --- Configuração do WebDriver ---
service = Service() # Se o chromedriver estiver no PATH
driver = webdriver.Chrome(service=service)

# URL da sua página de cadastro (ajuste conforme a sua aplicação Laravel)
BASE_URL = 'http://127.0.0.1:8000/register'

def test_cadastro_valido():
    print("Iniciando teste: Cadastro com dados válidos")
    driver.get(BASE_URL)

    try:
        # Espera até que o campo de nome esteja visível
        WebDriverWait(driver, 10).until(
            EC.visibility_of_element_located((By.ID, "name"))
        )

        nome_input = driver.find_element(By.ID, "name")
        email_input = driver.find_element(By.ID, "email")
        senha_input = driver.find_element(By.ID, "password")
        confirmar_senha_input = driver.find_element(By.ID, "confirm-password")
        submit_button = driver.find_element(By.CLASS_NAME, "register-button")

        timestamp = int(time.time())
        email_unico = f"teste{timestamp}@example.com"

        # Adicionando um pequeno atraso após cada interação para visualização
        nome_input.send_keys("Nome Teste Automatizado")
        time.sleep(0.5) # Atraso de 0.5 segundos após preencher o nome

        email_input.send_keys(email_unico)
        time.sleep(0.5) # Atraso de 0.5 segundos após preencher o email

        senha_input.send_keys("SenhaSegura123")
        time.sleep(0.5) # Atraso de 0.5 segundos após preencher a senha

        confirmar_senha_input.send_keys("SenhaSegura123")
        time.sleep(0.5) # Atraso de 0.5 segundos após preencher a confirmação de senha

        print("Campos preenchidos. Clicando em 'Criar Conta'...")
        submit_button.click()
        time.sleep(1) # Atraso de 1 segundo após clicar no botão

        # --- Verificação Pós-Cadastro ---
        WebDriverWait(driver, 10).until(
            EC.url_contains('/home') # Adapte para a rota de sucesso do seu Laravel
        )
        print(f"Redirecionado para: {driver.current_url}")
        assert "/home" in driver.current_url, "Falha: Não foi redirecionado para a página de sucesso."
        print("Teste de cadastro válido CONCLUÍDO COM SUCESSO!")

    except Exception as e:
        print(f"Ocorreu um erro durante o teste de cadastro válido: {e}")
        driver.save_screenshot("erro_cadastro_valido.png")
        raise

    finally:
        driver.quit()

def test_senhas_nao_coincidem():
    print("\nIniciando teste: Senhas não coincidem")
    # Nota: Em um ambiente de teste real, você reiniciaria o driver ou usaria um setup/teardown
    # Para este exemplo simples, vamos reutilizar a instância global (que será fechada e reaberta pelo if __name__ == "__main__")
    driver.get(BASE_URL) # Acessa a URL novamente

    try:
        WebDriverWait(driver, 10).until(
            EC.visibility_of_element_located((By.ID, "name"))
        )

        nome_input = driver.find_element(By.ID, "name")
        email_input = driver.find_element(By.ID, "email")
        senha_input = driver.find_element(By.ID, "password")
        confirmar_senha_input = driver.find_element(By.ID, "confirm-password")
        submit_button = driver.find_element(By.CLASS_NAME, "register-button")

        timestamp = int(time.time())
        email_unico = f"teste_erro_senha{timestamp}@example.com"

        nome_input.send_keys("Outro Nome")
        time.sleep(1)

        email_input.send_keys(email_unico)
        time.sleep(1)

        senha_input.send_keys("Senha123")
        time.sleep(1)

        confirmar_senha_input.send_keys("SenhaDiferente456")
        time.sleep(1)

        print("Campos preenchidos com senhas diferentes. Clicando em 'Criar Conta'...")
        submit_button.click()
        time.sleep(1)

        # --- Verificação de Erro ---
        WebDriverWait(driver, 10).until(
            EC.visibility_of_element_located((By.CLASS_NAME, "error-message"))
        )
        error_message = driver.find_element(By.CLASS_NAME, "error-message").text

        assert "The password confirmation does not match." in error_message or \
               "As senhas não conferem." in error_message, \
               f"Falha: Mensagem de erro esperada não encontrada. Mensagem: {error_message}"
        print(f"Mensagem de erro exibida: '{error_message}'")
        print("Teste de senhas não coincidentes CONCLUÍDO COM SUCESSO!")

    except Exception as e:
        print(f"Ocorreu um erro durante o teste de senhas não coincidentes: {e}")
        driver.save_screenshot("erro_senhas_nao_coincidem.png")
        raise
    finally:
        driver.quit() # Garante que o navegador seja fechado

# --- Executar os testes ---
if __name__ == "__main__":
    # Para rodar ambos os testes de forma isolada, precisamos criar uma nova instância do driver
    # para cada função de teste, ou usar um framework de testes (como pytest) que gerencia isso.

    # Teste de cadastro válido
    test_cadastro_valido()

    # Reinicia o driver para o próximo teste para garantir um estado limpo
    driver = webdriver.Chrome(service=service)
    test_senhas_nao_coincidem()

    # Você pode adicionar mais chamadas para outras funções de teste aqui,
    # lembrando de reiniciar o driver entre cada uma se elas forem independentes.