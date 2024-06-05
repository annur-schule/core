@echo off
setlocal

if not exist Dockerfile (
	echo Necessary files do not exist. Not running from correct folder?
	pause
	exit /b
)

docker image build -t annurschule/gibbon:php7.4 . 

start /B docker-compose up

rem create a delay
ping 127.0.0.1 -n 6 > nul

msg * "If the downloading is finished in the other window, then open localhost:8081 in your browser."

