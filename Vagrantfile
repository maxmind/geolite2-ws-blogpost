Vagrant.configure(2) do |config|
  config.vm.box = 'ubuntu/focal64'

  config.trigger.before [:up, :reload] do |t|
    t.ruby do
      unless ENV.has_key?('MM_ACCOUNT_ID') && ENV['MM_ACCOUNT_ID'] && ENV.has_key?('MM_LICENSE_KEY') && ENV['MM_LICENSE_KEY']
        raise 'The MM_ACCOUNT_ID and MM_LICENSE_KEY env vars must be defined. Please define them before running "vagrant up".'
      end
    end
    t.ignore = [:destroy, :halt]
  end

  config.vm.provision 'shell', inline: <<-SHELL
    apt-get install software-properties-common
    add-apt-repository ppa:ondrej/php

    apt-get update
    apt-get install -y php8.0 php8.0-curl unzip
  SHELL

  config.vm.provision 'shell', privileged: false, inline: <<-SHELL
    echo export MM_ACCOUNT_ID="#{ENV['MM_ACCOUNT_ID']}" >> /home/vagrant/.profile
    echo export MM_LICENSE_KEY="#{ENV['MM_LICENSE_KEY']}" >> /home/vagrant/.profile
    cd /vagrant
    curl -sS https://getcomposer.org/installer | php
    php composer.phar require geoip2/geoip2:~2.0
  SHELL

  config.vm.network "forwarded_port", guest: 9595, host: 9595
end
