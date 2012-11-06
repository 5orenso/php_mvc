eval `ssh-agent -s`
ssh-add /srv/keys/github_rsa
git fetch
git checkout $1
git submodule update --init --recursive
sudo rm -rf view_cache/
