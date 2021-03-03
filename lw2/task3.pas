PROGRAM HelloDear(INPUT, OUTPUT);
USES
  DOS;
VAR
  Name: STRING;
    
FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, KeyString: STRING;
  Index, Len: BYTE; 
BEGIN
  KeyString := Key + '=';
  QueryString := GetEnv('QUERY_STRING');
  Len := length(QueryString);
  IF Len = 0
  THEN
    GetQueryStringParameter := ''
  ELSE
    BEGIN
      Index := pos(KeyString, QueryString);
      IF Index = 0
      THEN
        GetQueryStringParameter := ''
      ELSE
        BEGIN
          QueryString := copy(QueryString, Index + length(KeyString), Len - Index);
          IF pos('&', QueryString) = 0
          THEN
            QueryString := copy(QueryString, 1, length(QueryString));
          GetQueryStringParameter := QueryString  
        END          
    END
END;
  
BEGIN {HelloDear}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  Name := GetQueryStringParameter('name');
  IF length(Name) = 0
  THEN 
    WRITELN('Hello Anonymous!')
  ELSE  
    WRITELN('Hello dear, ', Name, '!')
END. {HelloDear}
