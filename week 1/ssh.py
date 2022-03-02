import paramiko
TARGET = '192.168.182.128'
PORT = 22

# 1. bikin object sshclient
ssh_client = paramiko.SSHClient()

# set auto add policy
ssh_client.set_missing_host_key_policy(paramiko.AutoAddPolicy())

# connect target ip, port ,username ,password
try:
    ssh_client.connect(hostname=TARGET, port=PORT, username="test", password="test")
except:
    print("connection failed")
else:
    print("connection success")
