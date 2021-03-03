PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;
  
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
          Index := pos('&', QueryString);
          IF Index = 0
          THEN
            GetQueryStringParameter := copy(QueryString, 1, length(QueryString))
          ELSE
            GetQueryStringParameter := copy(QueryString, 1, Index - 1)  
        END          
    END
END;
  
BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END. {WorkWithQueryString}

