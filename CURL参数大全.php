��һ�ࣺ
�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����һ��bool���͵�ֵ��
ѡ��
��ѡvalueֵ
��ע

CURLOPT_AUTOREFERER
������Location:�ض���ʱ���Զ�����header�е�Referer:��Ϣ��
CURLOPT_BINARYTRANSFER
������CURLOPT_RETURNTRANSFER��ʱ�򣬷���ԭ���ģ�Raw�������
CURLOPT_COOKIESESSION
����ʱcurl���������һ��session cookie������������cookie��Ĭ��״����cURL�Ὣ���е�cookie���ظ�����ˡ�session cookie��ָ��Щ�����жϷ������˵�session�Ƿ���Ч�����ڵ�cookie��
CURLOPT_CRLF
����ʱ��Unix�Ļ��з�ת���ɻس����з���
CURLOPT_DNS_USE_GLOBAL_CACHE
����ʱ������һ��ȫ�ֵ�DNS���棬����Ϊ�̰߳�ȫ�ģ�����Ĭ�����á�
CURLOPT_FAILONERROR
��ʾHTTP״̬�룬Ĭ����Ϊ�Ǻ��Ա��С�ڵ���400��HTTP��Ϣ��
CURLOPT_FILETIME
����ʱ�᳢���޸�Զ���ĵ��е���Ϣ�������Ϣ��ͨ�� curl_getinfo()������CURLINFO_FILETIMEѡ��ء�curl_getinfo().
CURLOPT_FOLLOWLOCATION
����ʱ�Ὣ���������������ص�"Location: "����header�еݹ�ķ��ظ���������ʹ��CURLOPT_MAXREDIRS�����޶��ݹ鷵�ص�������
CURLOPT_FORBID_REUSE
����ɽ����Ժ�ǿ�ȶϿ����ӣ��������á�
CURLOPT_FRESH_CONNECT
ǿ�ƻ�ȡһ���µ����ӣ���������е����ӡ�
CURLOPT_FTP_USE_EPRT
����ʱ��FTP����ʱ��ʹ��EPRT (�� LPRT)�������ΪFALSEʱ����EPRT��LPRT��ʹ��PORT���� only.
CURLOPT_FTP_USE_EPSV
����ʱ����FTP��������лظ���PASVģʽǰ���ȳ���EPSV�������ΪFALSEʱ����EPSV���
CURLOPT_FTPAPPEND
����ʱ׷��д���ļ������Ǹ�������
CURLOPT_FTPASCII
CURLOPT_TRANSFERTEXT�ı�����
CURLOPT_FTPLISTONLY
����ʱֻ�г�FTPĿ¼�����֡�
CURLOPT_HEADER
����ʱ�Ὣͷ�ļ�����Ϣ��Ϊ�����������
CURLINFO_HEADER_OUT
����ʱ׷�پ���������ַ�����
�� PHP 5.1.3 ��ʼ���á�CURLINFO_ǰ׺�ǹ����(intentional)��

CURLOPT_HTTPGET
����ʱ������HTTP��methodΪGET����ΪGET��Ĭ���ǣ�����ֻ�ڱ��޸ĵ������ʹ�á�
CURLOPT_HTTPPROXYTUNNEL
����ʱ��ͨ��HTTP���������䡣
CURLOPT_MUTE
����ʱ��cURL�����������޸Ĺ��Ĳ����ָ�Ĭ��ֵ��
CURLOPT_NETRC
�����ӽ����Ժ󣬷���~/.netrc�ļ���ȡ�û�����������Ϣ����Զ��վ�㡣
CURLOPT_NOBODY
����ʱ������HTML�е�BODY���ֽ��������
CURLOPT_NOPROGRESS
����ʱ�ر�curl����Ľ������������Ĭ������Ϊ���á�
Note:
PHP�Զ����������ѡ��ΪTRUE�����ѡ�����Ӧ�����Ե���ΪĿ��ʱ���ı䡣

CURLOPT_NOSIGNAL
����ʱ�������е�curl���ݸ�php���е��źš���SAPI���̴߳���ʱ���Ĭ�����á�
cURL 7.10ʱ�����롣

CURLOPT_POST
����ʱ�ᷢ��һ�������POST��������Ϊ��application/x-www-form-urlencoded��������ύ��һ����
CURLOPT_PUT
����ʱ����HTTP�����ļ�������ͬʱ����CURLOPT_INFILE��CURLOPT_INFILESIZE��
CURLOPT_RETURNTRANSFER
�� curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ�������
CURLOPT_SSL_VERIFYPEER
���ú�cURL����ֹ�ӷ���˽�����֤��ʹ��CURLOPT_CAINFOѡ������֤��ʹ��CURLOPT_CAPATHѡ������֤��Ŀ¼ ���CURLOPT_SSL_VERIFYPEER(Ĭ��ֵΪ2)�����ã�CURLOPT_SSL_VERIFYHOST��Ҫ�����ó�TRUE��������ΪFALSE��
��cURL 7.10��ʼĬ��ΪTRUE����cURL 7.10��ʼĬ�ϰ󶨰�װ��

CURLOPT_TRANSFERTEXT
���ú��FTP����ʹ��ASCIIģʽ������LDAP�����������ı���Ϣ����HTML����Windowsϵͳ�ϣ�ϵͳ�����STDOUT���ó�binaryģʽ��
CURLOPT_UNRESTRICTED_AUTH
��ʹ��CURLOPT_FOLLOWLOCATION������header�еĶ��locations�г���׷���û�����������Ϣ����ʹ�����ѷ����ı䡣
CURLOPT_UPLOAD
���ú������ļ��ϴ���
CURLOPT_VERBOSE
����ʱ��㱨���е���Ϣ�������STDERR��ָ����CURLOPT_STDERR�С�

�ڶ��ࣺ
�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����һ��integer���͵�ֵ��
ѡ��
��ѡvalueֵ
��ע

CURLOPT_BUFFERSIZE
ÿ�λ�ȡ�������ж��뻺��Ĵ�С�����ǲ���֤���ֵÿ�ζ��ᱻ������
��cURL 7.10�б����롣

CURLOPT_CLOSEPOLICY
����CURLCLOSEPOLICY_LEAST_RECENTLY_USED����CURLCLOSEPOLICY_OLDEST����������������CURLCLOSEPOLICY_������cURL��ʱ����֧�֡�
CURLOPT_CONNECTTIMEOUT
�ڷ�������ǰ�ȴ���ʱ�䣬�������Ϊ0�������޵ȴ���
CURLOPT_CONNECTTIMEOUT_MS
�������ӵȴ���ʱ�䣬�Ժ���Ϊ��λ���������Ϊ0�������޵ȴ���
��cURL 7.16.2�б����롣��PHP 5.2.3��ʼ���á�

CURLOPT_DNS_CACHE_TIMEOUT
�������ڴ��б���DNS��Ϣ��ʱ�䣬Ĭ��Ϊ120�롣
CURLOPT_FTPSSLAUTH
FTP��֤��ʽ��CURLFTPAUTH_SSL (���ȳ���SSL)��CURLFTPAUTH_TLS (���ȳ���TLS)��CURLFTPAUTH_DEFAULT (��cURL�Զ�����)��
��cURL 7.12.2�б����롣

CURLOPT_HTTP_VERSION
CURL_HTTP_VERSION_NONE (Ĭ��ֵ����cURL�Լ��ж�ʹ���ĸ��汾)��CURL_HTTP_VERSION_1_0 (ǿ��ʹ�� HTTP/1.0)��CURL_HTTP_VERSION_1_1 (ǿ��ʹ�� HTTP/1.1)��
CURLOPT_HTTPAUTH
ʹ�õ�HTTP��֤��������ѡ��ֵ�У�CURLAUTH_BASIC��CURLAUTH_DIGEST��CURLAUTH_GSSNEGOTIATE��CURLAUTH_NTLM��CURLAUTH_ANY��CURLAUTH_ANYSAFE��
����ʹ��|λ��(��)�������ָ����ֵ��cURL�÷�����ѡ��һ��֧����õ�ֵ��
CURLAUTH_ANY�ȼ���CURLAUTH_BASIC | CURLAUTH_DIGEST | CURLAUTH_GSSNEGOTIATE | CURLAUTH_NTLM.
CURLAUTH_ANYSAFE�ȼ���CURLAUTH_DIGEST | CURLAUTH_GSSNEGOTIATE | CURLAUTH_NTLM.
CURLOPT_INFILESIZE
�趨�ϴ��ļ��Ĵ�С���ƣ��ֽ�(byte)Ϊ��λ��
CURLOPT_LOW_SPEED_LIMIT
�������ٶ�С��CURLOPT_LOW_SPEED_LIMITʱ(bytes/sec)��PHP�����CURLOPT_LOW_SPEED_TIME���ж��Ƿ���̫����ȡ�����䡣
CURLOPT_LOW_SPEED_TIME
�������ٶ�С��CURLOPT_LOW_SPEED_LIMITʱ(bytes/sec)��PHP�����CURLOPT_LOW_SPEED_TIME���ж��Ƿ���̫����ȡ�����䡣
CURLOPT_MAXCONNECTS
�����������������������ǻ�ͨ��CURLOPT_CLOSEPOLICY����Ӧ��ֹͣ��Щ���ӡ�
CURLOPT_MAXREDIRS
ָ������HTTP�ض�������������ѡ���Ǻ�CURLOPT_FOLLOWLOCATIONһ��ʹ�õġ�
CURLOPT_PORT
����ָ�����Ӷ˿ڡ�����ѡ�
CURLOPT_PROTOCOLS
CURLPROTO_*��λ��ָ����������ã�λ��ֵ���޶�libcurl�ڴ������������Щ��ʹ�õ�Э�顣�⽫�������ڱ���libcurlʱ֧���ڶ�Э�飬��������ֻ���������б�����ʹ�õ�һ���Ӽ���Ĭ��libcurl����ʹ��ȫ����֧�ֵ�Э�顣�μ�CURLOPT_REDIR_PROTOCOLS.
���õ�Э��ѡ��Ϊ��CURLPROTO_HTTP��CURLPROTO_HTTPS��CURLPROTO_FTP��CURLPROTO_FTPS��CURLPROTO_SCP��CURLPROTO_SFTP��CURLPROTO_TELNET��CURLPROTO_LDAP��CURLPROTO_LDAPS��CURLPROTO_DICT��CURLPROTO_FILE��CURLPROTO_TFTP��CURLPROTO_ALL
��cURL 7.19.4�б����롣

CURLOPT_PROXYAUTH
HTTP�������ӵ���֤��ʽ��ʹ����CURLOPT_HTTPAUTH�е�λ���־��������Ӧѡ����ڴ�����ֻ֤��CURLAUTH_BASIC��CURLAUTH_NTLM��ǰ��֧�֡�
��cURL 7.10.7�б����롣

CURLOPT_PROXYPORT
����������Ķ˿ڡ��˿�Ҳ������CURLOPT_PROXY�н������á�
CURLOPT_PROXYTYPE
����CURLPROXY_HTTP (Ĭ��ֵ) ����CURLPROXY_SOCKS5��
��cURL 7.10�б����롣

CURLOPT_REDIR_PROTOCOLS
CURLPROTO_*�е�λ��ֵ����������ã�λ��ֵ�������ƴ����߳���CURLOPT_FOLLOWLOCATION����ʱ����ĳ���ض���ʱ��ʹ�õ�Э�顣�⽫ʹ����ض���ʱ���ƴ����߳�ʹ�ñ������Э���Ӽ�Ĭ��libcurl���������FILE��SCP֮���ȫ��Э�顣�����7.19.4Ԥ�����汾���������ظ�������֧�ֵ�Э����һЩ��ͬ������Э�鳣���������CURLOPT_PROTOCOLS��
��cURL 7.19.4�б����롣

CURLOPT_RESUME_FROM
�ڻָ�����ʱ����һ���ֽ�ƫ�����������ϵ���������
CURLOPT_SSL_VERIFYHOST
1 ��������SSL֤�����Ƿ����һ��������(common name)������ע��������(Common Name)һ������������д�㽫Ҫ����SSL֤������� (domain)��������(sub domain)��2 ��鹫�����Ƿ���ڣ������Ƿ����ṩ��������ƥ�䡣
CURLOPT_SSLVERSION
ʹ�õ�SSL�汾(2 �� 3)��Ĭ�������PHP���Լ�������ֵ��������Щ�������Ҫ�ֶ��ؽ������á�
CURLOPT_TIMECONDITION
�����CURLOPT_TIMEVALUEָ����ĳ��ʱ���Ժ󱻱༭������ʹ��CURL_TIMECOND_IFMODSINCE����ҳ�棬���û�б��޸Ĺ�������CURLOPT_HEADERΪtrue���򷵻�һ��"304 Not Modified"��header��        CURLOPT_HEADERΪfalse����ʹ��CURL_TIMECOND_IFUNMODSINCE��Ĭ��ֵΪCURL_TIMECOND_IFUNMODSINCE��
CURLOPT_TIMEOUT
����cURL����ִ�е��������
CURLOPT_TIMEOUT_MS
����cURL����ִ�е����������
��cURL 7.16.2�б����롣��PHP 5.2.3���ʹ�á�

CURLOPT_TIMEVALUE
����һ��CURLOPT_TIMECONDITIONʹ�õ�ʱ�������Ĭ��״̬��ʹ�õ���CURL_TIMECOND_IFMODSINCE��
 
�����ࣺ
�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����һ��string���͵�ֵ��
ѡ��
��ѡvalueֵ
��ע

CURLOPT_CAINFO
һ��������1�����������÷������֤��֤����ļ�����������������ں�CURLOPT_SSL_VERIFYPEERһ��ʹ��ʱ�������塣 .
CURLOPT_CAPATH
һ�������Ŷ��CA֤���Ŀ¼�����ѡ���Ǻ�CURLOPT_SSL_VERIFYPEERһ��ʹ�õġ�
CURLOPT_COOKIE
�趨HTTP������"Cookie: "���ֵ����ݡ����cookie�÷ֺŷָ����ֺź��һ���ո�(���磬 "fruit=apple; colour=red")��
CURLOPT_COOKIEFILE
����cookie���ݵ��ļ�����cookie�ļ��ĸ�ʽ������Netscape��ʽ������ֻ�Ǵ�HTTPͷ����Ϣ�����ļ���
CURLOPT_COOKIEJAR
���ӽ����󱣴�cookie��Ϣ���ļ���
CURLOPT_CUSTOMREQUEST
ʹ��һ���Զ����������Ϣ������"GET"��"HEAD"��ΪHTTP���������ִ��"DELETE" �������������ε�HTTP������Чֵ��"GET"��"POST"��"CONNECT"�ȵȡ�Ҳ����˵����Ҫ��������������HTTP������������"GET /index.html HTTP/1.0\r\n\r\n"�ǲ���ȷ�ġ�
Note:
��ȷ��������֧������Զ�������ķ���ǰ��Ҫʹ�á�

 
CURLOPT_EGDSOCKET
����CURLOPT_RANDOM_FILE������һ��Entropy Gathering Daemon�׽��֡�
CURLOPT_ENCODING
HTTP����ͷ��"Accept-Encoding: "��ֵ��֧�ֵı�����"identity"��"deflate"��"gzip"�����Ϊ���ַ���""������ͷ�ᷢ������֧�ֵı������͡�
��cURL 7.10�б����롣

CURLOPT_FTPPORT
���ֵ����������ȡ��FTP"POST"ָ������Ҫ��IP��ַ��"POST"ָ�����Զ�̷��������ӵ�����ָ����IP��ַ������ַ��������Ǵ��ı���IP��ַ����������һ������ӿ�����UNIX�£�����ֻ��һ��'-'��ʹ��Ĭ�ϵ�IP��ַ��
CURLOPT_INTERFACE
���緢�ͽӿ�����������һ���ӿ�����IP��ַ������һ����������
CURLOPT_KRB4LEVEL
KRB4 (Kerberos 4) ��ȫ����������κ�ֵ������Ч��(�ӵ͵��ߵ�˳��)��"clear"��"safe"��"confidential"��"private".������ַ�������Щ����ƥ�䣬��ʹ��"private"�����ѡ������ΪNULLʱ������KRB4 ��ȫ��֤��ĿǰKRB4 ��ȫ��ֻ֤������FTP���䡣
CURLOPT_POSTFIELDS
ȫ������ʹ��HTTPЭ���е�"POST"���������͡�Ҫ�����ļ������ļ���ǰ�����@ǰ׺��ʹ������·���������������ͨ��urlencoded����ַ�������'para1=val1?2=val2&...'��ʹ��һ�����ֶ���Ϊ��ֵ���ֶ�����Ϊֵ�����顣���value��һ�����飬Content-Typeͷ���ᱻ���ó�multipart/form-data��
CURLOPT_PROXY
HTTP����ͨ����
CURLOPT_PROXYUSERPWD
һ���������ӵ������"[username]:[password]"��ʽ���ַ�����
CURLOPT_RANDOM_FILE
һ������������SSL��������ӵ��ļ�����
CURLOPT_RANGE
��"X-Y"����ʽ������X��Y���ǿ�ѡ���ȡ���ݵķ�Χ�����ֽڼơ�HTTP�����߳�Ҳ֧�ּ����������ظ����м��ö��ŷָ���"X-Y,N-M"��
CURLOPT_REFERER
��HTTP����ͷ��"Referer: "�����ݡ�
CURLOPT_SSL_CIPHER_LIST
һ��SSL�ļ����㷨�б�����RC4-SHA��TLSv1���ǿ��õļ����б�
CURLOPT_SSLCERT
һ������PEM��ʽ֤����ļ�����
CURLOPT_SSLCERTPASSWD
ʹ��CURLOPT_SSLCERT֤����Ҫ�����롣
CURLOPT_SSLCERTTYPE
֤������͡�֧�ֵĸ�ʽ��"PEM" (Ĭ��ֵ), "DER"��"ENG"��
��cURL 7.9.3�б����롣

CURLOPT_SSLENGINE
������CURLOPT_SSLKEY��ָ����SSL˽Կ�ļ������������
CURLOPT_SSLENGINE_DEFAULT
�������ǶԳƼ��ܲ����ı�����
CURLOPT_SSLKEY
����SSL˽Կ���ļ�����
CURLOPT_SSLKEYPASSWD
��CURLOPT_SSLKEY��ָ���˵�SSL˽Կ�����롣
Note:
�������ѡ����������е�������Ϣ���ǵñ�֤���PHP�ű��İ�ȫ��

CURLOPT_SSLKEYTYPE
CURLOPT_SSLKEY�й涨��˽Կ�ļ������ͣ�֧�ֵ���Կ����Ϊ"PEM"(Ĭ��ֵ)��"DER"��"ENG"��
CURLOPT_URL
��Ҫ��ȡ��URL��ַ��Ҳ������ curl_init()���������á�
CURLOPT_USERAGENT
��HTTP�����а���һ��"User-Agent: "ͷ���ַ�����
CURLOPT_USERPWD
����һ����������Ҫ���û��������룬��ʽΪ��"[username]:[password]"��

 
������
�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����һ�����飺
ѡ��
��ѡvalueֵ
��ע
 
CURLOPT_HTTP200ALIASES
200��Ӧ�����飬�����е���Ӧ����Ϊ����ȷ����Ӧ��������Ϊ�Ǵ���ġ�
��cURL 7.10.3�б����롣

CURLOPT_HTTPHEADER
һ����������HTTPͷ�ֶε����顣ʹ�����µ���ʽ������������ã� array('Content-type: text/plain', 'Content-length: 100')
CURLOPT_POSTQUOTE
��FTP����ִ����ɺ��ڷ�������ִ�е�һ��FTP���
CURLOPT_QUOTE
һ������FTP������ڷ�������ִ�е�FTP���

�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����һ������Դ ������ʹ�� fopen()����
ѡ��
��ѡvalueֵ

CURLOPT_FILE
��������ļ���λ�ã�ֵ��һ����Դ���ͣ�Ĭ��ΪSTDOUT (�����)��

CURLOPT_INFILE
���ϴ��ļ���ʱ����Ҫ��ȡ���ļ���ַ��ֵ��һ����Դ���͡�

CURLOPT_STDERR
����һ�����������ַ��ֵ��һ����Դ���ͣ�ȡ��Ĭ�ϵ�STDERR��

CURLOPT_WRITEHEADER
����header�������ݵ�д����ļ���ַ��ֵ��һ����Դ���͡�

�����������Щoption�Ŀ�ѡ������valueӦ�ñ�����Ϊһ���ص���������
ѡ��
��ѡvalueֵ

CURLOPT_HEADERFUNCTION
����һ���ص����������������������������һ����cURL����Դ������ڶ����������header���ݡ�header���ݵ���������������������������д������ݴ�С��

CURLOPT_PASSWDFUNCTION
����һ���ص���������������������һ����cURL����Դ������ڶ�����һ��������ʾ�������������������볤����������ֵ�����������ֵ��

CURLOPT_PROGRESSFUNCTION
����һ���ص���������������������һ����cURL����Դ������ڶ�����һ���ļ���������Դ���������ǳ��ȡ����ذ��������ݡ�
 
CURLOPT_READFUNCTION
ӵ�����������Ļص���������һ���ǲ����ǻỰ������ڶ���HTTP��Ӧͷ��Ϣ���ַ�����ʹ�ô˺����������д����ص����ݡ�����ֵΪ���ݴ�С�����ֽڼơ�����0����EOF�źš�

CURLOPT_WRITEFUNCTION
ӵ�����������Ļص���������һ���ǲ����ǻỰ������ڶ���HTTP��Ӧͷ��Ϣ���ַ�����ʹ�ô˻ص������������д�����Ӧͷ��Ϣ����Ӧͷ��Ϣ�������ַ��������÷���ֵΪ��ȷ����д���ַ������ȡ���������ʱ�����߳���ֹ��