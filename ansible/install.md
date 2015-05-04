#sudo apt-get install python-dev
sudo apt-get install software-properties-common
sudo apt-add-repository ppa:ansible/ansible
sudo apt-get update
sudo apt-get install ansible
sudo apt-get install sshpass

#ssh-keygen
#ssh-copy-id -i ~/.ssh/id_rsa.pub root@192.168.0.4

#ssh-agent bash #有密码的时候 自动填充密码
#ssh-add ~/.ssh/id_rsa

.bashrc
if [ -f ~/.agent.env ]; then
. ~/.agent.env >/dev/null
if ! kill -s 0 $SSH_AGENT_PID >/dev/null 2>&1; then
echo "Stale agent file found. Spawning new agent..."
eval `ssh-agent |tee ~/.agent.env`
ssh-add
fielse
echo "Starting ssh-agent..."
eval `ssh-agent |tee ~/.agent.env`
ssh-add
fi