default:
	@echo "Please specify a command"

docs:
	@echo "Creating documentation..."
	headerdoc2html -o ../docs ../
	gatherheaderdoc ../docs toc.html
	
upgrade-framework:
	@echo "Upgrading OrangePHP framework..."
	rm -rf /tmp/orangephp-upgrade
	git clone https://github.com/revned/orangephp.git /tmp/orangephp-upgrade
	rm -rf /tmp/orangephp-upgrade/.git
	cp -R /tmp/orangephp-upgrade/ ../
	rm -rf /tmp/orangephp-upgrade