Vagrant.configure("2") do |config|
  config.vm.box = "hashicorp/bionic64"
  config.vm.box_check_update = true
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.network "public_network", bridge: "Intel(R) 82579LM Gigabit Network Connection"
  config.vm.synced_folder "Calculator", "/var/www/Calculator"
  config.vm.provider "virtualbox" do |vb|
     vb.memory = "2024"
  end
   config.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2
     apt-get install -y mysql-server
     apt-get install -y phpmyadmin
     touch /etc/apache2/sites-enabled/Calculator.conf
     echo "<VirtualHost *:80>\nServerName Calculator.develop\nServerAlias Calculator.develop\nDocumentRoot /var/www/Calculator/\nErrorLog /var/www/Calculator/error.log\nCustomLog /var/www/Calculator/requests.log combined\n</VirtualHost>" > /etc/apache2/sites-enabled/Calculator.conf
     sudo ln -s /etc/apache2/sites-enabled/Calculator.conf /etc/apache2/sites-available/
     sudo a2ensite /etc/apache2/sites-enabled/Calculator.conf
     sudo service apache2 restart
   SHELL
end