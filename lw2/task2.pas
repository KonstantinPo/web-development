PROGRAM PaulRevere(INPUT, OUTPUT);
USES
  DOS;
VAR
  Lanterns: STRING;
    
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
  Lanterns := GetQueryStringParameter('lanterns');
  IF Lanterns = '2'
  THEN 
    WRITELN('The british are coming by sea')
  ELSE
    IF Lanterns = '1'
    THEN    
      WRITELN('The british are coming by land')
    ELSE
      WRITELN('The british are coming by air')  
END. {HelloDear}
