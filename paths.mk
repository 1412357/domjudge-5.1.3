# Variables (mostly paths) set by configure.
# This file is globally included via Makefile.global.

# General package variables
PACKAGE = domjudge
VERSION = 5.1.3
DISTNAME = $(PACKAGE)-$(VERSION)

# The following line is automatically modified by snapshot/release
# scripts, do not change manually!
PUBLISHED = release

PACKAGE_NAME      = DOMjudge
PACKAGE_VERSION   = 5.1.3
PACKAGE_STRING    = DOMjudge 5.1.3
PACKAGE_TARNAME   = domjudge
PACKAGE_BUGREPORT = domjudge-devel@domjudge.org

# Compilers and FLAGS
CC  = gcc
CXX = g++
CPP = gcc -E

CFLAGS   = -g -O2 -Wall -fstack-protector -fPIE -D_FORTIFY_SOURCE=2
CXXFLAGS = -g -O2 -Wall -fstack-protector -fPIE -D_FORTIFY_SOURCE=2
CPPFLAGS = 
LDFLAGS  =  -fPIE -pie -Wl,-z,relro -Wl,-z,now 

STATIC_LINK_START = 
STATIC_LINK_END   = 

EXEEXT = 
OBJEXT = .o

# Other programs
LN_S    = ln -s
MKDIR_P = /bin/mkdir -p
INSTALL = /usr/bin/install -c


# Build submit client?
SUBMITCLIENT_ENABLED = yes

# Use Linux cgroups?
USE_CGROUPS = 1

# libcgroup
LIBCGROUP = -lcgroup

# libmagic
LIBMAGIC = -lmagic

# libJSONcpp
LIBJSONCPP = -ljsoncpp

# libcURL
CURL_CFLAGS = 
CURL_LIBS   = -L/usr/lib/i386-linux-gnu -lcurl
CURL_STATIC = 

# User:group file ownership of password files
DOMJUDGE_USER   = nguyen
WEBSERVER_GROUP = www-data

# Autoconf prefixes and paths
FHS_ENABLED    = no

prefix         = /var/www/contest
exec_prefix    = ${prefix}

bindir         = ${exec_prefix}/bin
sbindir        = ${exec_prefix}/sbin
libexecdir     = ${exec_prefix}/libexec
sysconfdir     = ${prefix}/etc
sharedstatedir = ${prefix}/com
localstatedir  = ${prefix}/var
libdir         = ${exec_prefix}/lib
includedir     = ${prefix}/include
oldincludedir  = /usr/include
datarootdir    = ${prefix}/share
datadir        = ${datarootdir}
infodir        = ${datarootdir}/info
localedir      = ${datarootdir}/locale
mandir         = ${datarootdir}/man
docdir         = ${datarootdir}/doc/${PACKAGE_TARNAME}
htmldir        = ${docdir}
dvidir         = ${docdir}
pdfdir         = ${docdir}
psdir          = ${docdir}

# Installation paths
domserver_bindir       = /var/www/contest/domserver/bin
domserver_etcdir       = /var/www/contest/domserver/etc
domserver_wwwdir       = /var/www/contest/domserver/www
domserver_sqldir       = /var/www/contest/domserver/sql
domserver_libdir       = /var/www/contest/domserver/lib
domserver_libextdir    = /var/www/contest/domserver/lib/ext
domserver_libwwwdir    = /var/www/contest/domserver/lib/www
domserver_libsubmitdir = /var/www/contest/domserver/lib/submit
domserver_logdir       = /var/www/contest/domserver/log
domserver_rundir       = /var/www/contest/domserver/run
domserver_tmpdir       = /var/www/contest/domserver/tmp
domserver_submitdir    = /var/www/contest/domserver/submissions

judgehost_bindir       = /var/www/contest/judgehost/bin
judgehost_etcdir       = /var/www/contest/judgehost/etc
judgehost_libdir       = /var/www/contest/judgehost/lib
judgehost_libextdir    = /var/www/contest/judgehost/lib/ext
judgehost_libjudgedir  = /var/www/contest/judgehost/lib/judge
judgehost_logdir       = /var/www/contest/judgehost/log
judgehost_rundir       = /var/www/contest/judgehost/run
judgehost_tmpdir       = /var/www/contest/judgehost/tmp
judgehost_judgedir     = /var/www/contest/judgehost/judgings
judgehost_chrootdir    = /chroot/domjudge
judgehost_cgroupdir    = /cgroup

domjudge_docdir        = /var/www/contest/doc

domserver_dirs = $(domserver_bindir) $(domserver_etcdir) $(domserver_wwwdir) \
                 $(domserver_libdir) $(domserver_libsubmitdir) $(domserver_libextdir) \
                 $(domserver_libwwwdir) $(domserver_logdir) $(domserver_rundir) \
                 $(domserver_tmpdir) $(domserver_submitdir) $(domserver_sqldir)/upgrade \
                 $(addprefix $(domserver_wwwdir)/images/,affiliations countries teams) \
                 $(addprefix $(domserver_wwwdir)/,public team jury api auth js js/flot js/ace)

judgehost_dirs = $(judgehost_bindir) $(judgehost_etcdir) $(judgehost_libdir) \
                 $(judgehost_libextdir) $(judgehost_libjudgedir) $(judgehost_logdir) \
                 $(judgehost_rundir) $(judgehost_tmpdir) $(judgehost_judgedir)

docs_dirs      = $(addprefix $(domjudge_docdir)/,admin judge team examples logos)

# Macro to substitute configure variables.
# Defined in makefile to allow for expansion of ${prefix} etc. during
# build and install, conforming to the GNU coding standards, see:
# http://www.gnu.org/software/hello/manual/autoconf/Installation-Directory-Variables.html
define substconfigvars
@[ -n "$(QUIET)" ] || echo "Substituting configure variables in '$@'."
@cat $< | sed \
	-e "s|@configure_input[@]|Generated from '$<' on `date`.|g" \
	-e 's,@DOMJUDGE_VERSION[@],5.1.3,g' \
	-e 's,@domserver_bindir[@],/var/www/contest/domserver/bin,g' \
	-e 's,@domserver_etcdir[@],/var/www/contest/domserver/etc,g' \
	-e 's,@domserver_wwwdir[@],/var/www/contest/domserver/www,g' \
	-e 's,@domserver_sqldir[@],/var/www/contest/domserver/sql,g' \
	-e 's,@domserver_libdir[@],/var/www/contest/domserver/lib,g' \
	-e 's,@domserver_libextdir[@],/var/www/contest/domserver/lib/ext,g' \
	-e 's,@domserver_libwwwdir[@],/var/www/contest/domserver/lib/www,g' \
	-e 's,@domserver_libsubmitdir[@],/var/www/contest/domserver/lib/submit,g' \
	-e 's,@domserver_logdir[@],/var/www/contest/domserver/log,g' \
	-e 's,@domserver_rundir[@],/var/www/contest/domserver/run,g' \
	-e 's,@domserver_tmpdir[@],/var/www/contest/domserver/tmp,g' \
	-e 's,@domserver_submitdir[@],/var/www/contest/domserver/submissions,g' \
	-e 's,@judgehost_bindir[@],/var/www/contest/judgehost/bin,g' \
	-e 's,@judgehost_etcdir[@],/var/www/contest/judgehost/etc,g' \
	-e 's,@judgehost_libdir[@],/var/www/contest/judgehost/lib,g' \
	-e 's,@judgehost_libextdir[@],/var/www/contest/judgehost/lib/ext,g' \
	-e 's,@judgehost_libjudgedir[@],/var/www/contest/judgehost/lib/judge,g' \
	-e 's,@judgehost_logdir[@],/var/www/contest/judgehost/log,g' \
	-e 's,@judgehost_rundir[@],/var/www/contest/judgehost/run,g' \
	-e 's,@judgehost_tmpdir[@],/var/www/contest/judgehost/tmp,g' \
	-e 's,@judgehost_judgedir[@],/var/www/contest/judgehost/judgings,g' \
	-e 's,@judgehost_chrootdir[@],/chroot/domjudge,g' \
	-e 's,@judgehost_cgroupdir[@],/cgroup,g' \
	-e 's,@domjudge_docdir[@],/var/www/contest/doc,g' \
	-e 's,@DOMJUDGE_USER[@],nguyen,g' \
	-e 's,@WEBSERVER_GROUP[@],www-data,g' \
	-e 's,@BEEP[@],@BEEP@,g' \
	-e 's,@RUNUSER[@],domjudge-run,g' \
	-e 's,@SUBMITCLIENT_ENABLED[@],yes,g' \
	-e 's,@USE_CGROUPS[@],1,g' \
	> $@
endef
