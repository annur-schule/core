@echo off
setlocal

if not exist Dockerfile (
	echo Necessary files do not exist. Not running from correct folder?
	pause
	exit /b
)

rem Docker compose does the build
docker-compose up -d 

rem create a delay
ping 127.0.0.1 -n 6 > nul

msg * "If the image build and startup is finished in the other window, then open localhost:8081 in your browser."

