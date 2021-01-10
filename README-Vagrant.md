# Vagrant README

* [Getting Started](#getting-started)
* [Building Your Vagrant VM](#building-your-vagrant-vm)
* [Logging in to Your VM](#logging-in-to-your-vm)
* [Running the Code](#running-the-code)
* [Refactoring Your Code](#refactoring-your-code)

## Getting Started

A `Vagrantfile` has been provided in order to make this code more convenient to
run. To get started via `Vagrant`, you'll need:

* A working `Vagrant` environment with the VirtualBox provider
* A `git checkout` of this repository
* Your MaxMind Account ID and License Key

## Building Your Vagrant VM

After you have checked out this repository, run this command from the root
directory. (Replace `YOURACCOUNTID` with your MaxMind Account ID and replace
`YOURLICENSEKEY` with your License Key first. Some Vagrant users may need to
suffix the command with `--provider=virtualbox`.)

```bash
MM_ACCOUNT_ID=YOURACCOUNTID MM_LICENSE_KEY=YOURLICENSEKEY vagrant up
```

This will build your Vagrant VM.

## Logging in to Your VM

To log in to your container, run this command:

```bash
vagrant ssh
```

## Running the Code

Once you have logged in, you can run the server:

```bash
cd /vagrant
php -S 0:9595
```

Now you can visit http://localhost:9595 on your host machine and make GeoLite2
Web Service queries.

## Refactoring Your Code

You can now freely edit the code outside of the Vagrant VM and re-run it from
inside the VM.
