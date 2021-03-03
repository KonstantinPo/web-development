PROGRAM PrintEnvironments(INPUT, OUTPUT);
Uses
  Dos;
VAR
  Str: STRING;
  
PROCEDURE PrintEnvToFile(VAR OutputFile: TEXT; VAR Env: STRING);
BEGIN
  WRITE(OutputFile, Env, ' = ');
  Env := GetEnv(Env);
  WRITELN(OutputFile, Env)
END;

BEGIN {PrintEnv}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('Enviroments:');
  Str := 'REQUEST_METHOD';
  PrintEnvToFile(OUTPUT, Str);
  Str := 'CONTENT_LENGTH';  
  PrintEnvToFile(OUTPUT, Str);
  Str := 'HTTP_USER_AGENT';  
  PrintEnvToFile(OUTPUT, Str);
  Str := 'HTTP_HOST';  
  PrintEnvToFile(OUTPUT, Str);
  Str := 'QUERY_STRING';  
  PrintEnvToFile(OUTPUT, Str);      
END. {PrintEnv}
