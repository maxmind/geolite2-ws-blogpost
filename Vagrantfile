Vagrant.configure(2) do |config|
  config.vm.box = 'ubuntu/focal64'

  config.vm.provision 'shell', inline: <<-SHELL
    apt install software-properties-common
    add-apt-repository ppa:ondrej/php

    apt update
    apt install -y php8.0 php8.0-curl unzip
  SHELL

  config.vm.provision 'shell', privileged: false, inline: <<-SHELL
    cd /vagrant
    curl -sS https://getcomposer.org/installer | php
    php composer.phar require geoip2/geoip2:~2.0
    sed -i 's/MM_ACCOUNT_ID/#{ENV['MM_ACCOUNT_ID']}/' index.php
    sed -i 's/MM_LICENSE_KEY/#{ENV['MM_LICENSE_KEY']}/' index.php
  SHELL

  config.vm.network "forwarded_port", guest: 9595, host: 9595
end
