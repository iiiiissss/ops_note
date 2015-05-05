/*
 * Copyright (c) 2011 duowan.com. 
 * All Rights Reserved.
 * This program is the confidential and proprietary information of 
 * duowan. ("Confidential Information").  You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with duowan.com.
 */
package com.yy.latte.fdfs;

import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.Map;

import org.csource.common.NameValuePair;
import org.csource.fastdfs.ClientGlobal;
import org.csource.fastdfs.FileInfo;
import org.csource.fastdfs.StorageClient;
import org.csource.fastdfs.StorageClient1;
import org.csource.fastdfs.UploadCallback;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

/**
 * @author hongyuan
 * 
 */
public class FastdfsClient {

    private static final Logger LOG = LoggerFactory.getLogger(FastdfsClient.class);

    public static final char URL_SEPERATOR = '/';

    private String domain;

    public FastdfsClient(String config) throws Exception {
        ClientGlobal.init(config);
    }

    private NameValuePair[] convertMeta(Map<String, String> meta) {
        NameValuePair[] metaList = new NameValuePair[meta.size()];
        int i = 0;
        for (Map.Entry<String, String> me : meta.entrySet()) {
            metaList[i] = new NameValuePair(me.getKey(), me.getValue());
            i++;
        }
        return metaList;
    }

    public int deleteFile(String fileId) {
        try {
            StorageClient1 storageClient = new StorageClient1();
            int code = storageClient.delete_file1(fileId);
            if (code != 0) {
                LOG.error("delete file failed: {}", code);
            }
            return code;
        } catch (IOException e) {
            LOG.error("fastdfs delete File error:", e);
            return -1;
        } catch (Exception e) {
            LOG.error("fastdfs delete File error:", e);
            return -1;
        }
    }

    public int deleteFile(String group, String fileName) {
        try {
            StorageClient storageClient = new StorageClient();
            int code = storageClient.delete_file(group, fileName);
            if (code != 0) {
                LOG.error("delete file failed: {}", code);
            }
            return code;
        } catch (IOException e) {
            LOG.error("fastdfs delete File error:", e);
            return -1;
        } catch (Exception e) {
            LOG.error("fastdfs delete File error:", e);
            return -1;
        }
    }

    public String uploadFile(byte[] fileContent, String extName, boolean haveDomain) {
        try {
            StorageClient storageClient = new StorageClient();
            String[] info = storageClient.upload_file(fileContent, extName, null);
            if (info != null && info.length == 2) {
                if (haveDomain) {
                    return domain + info[0] + URL_SEPERATOR + info[1];
                } else {
                    return info[0] + URL_SEPERATOR + info[1];
                }
            } else {
                LOG.error("upload file error by extName: {}", extName);
            }
        } catch (IOException e) {
            LOG.error("fastdfs tracker get connection error:", e);
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadFile(String groupName, byte[] fileContent, String extName, boolean haveDomain) {
        try {
            StorageClient1 storageClient = new StorageClient1();
            String info = storageClient.upload_file1(groupName, fileContent, extName, null);
            if (info != null) {
                if (haveDomain) {
                    return domain + URL_SEPERATOR + info;
                } else {
                    return info;
                }
            } else {
                LOG.error("upload file error by extName: {}", extName);
            }
        } catch (IOException e) {
            LOG.error("fastdfs tracker get connection error:", e);
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadFile(byte[] fileContent, String extName, Map<String, String> meta) {
        try {
            StorageClient storageClient = new StorageClient();
            String[] info = storageClient.upload_file(fileContent, extName, convertMeta(meta));
            if (info != null && info.length == 2) {
                return domain + info[0] + URL_SEPERATOR + info[1];
            } else {
                LOG.error("upload file error by extName: {}", extName);
            }
        } catch (IOException e) {
            LOG.error("fastdfs upload error:", e);
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadFile(String filePath, String extName, boolean haveDomain) {
        try {
            StorageClient storageClient = new StorageClient();
            String[] info = storageClient.upload_file(filePath, extName, null);
            if (info != null && info.length == 2) {
                if (haveDomain) {
                    return domain + info[0] + URL_SEPERATOR + info[1];
                } else {
                    return info[0] + URL_SEPERATOR + info[1];
                }
            } else {
                LOG.error("upload file error by path: {}", filePath);
            }
        } catch (IOException e) {
            LOG.error("fastdfs tracker get connection error:", e);
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadFile(String groupName, String filePath, String extName, boolean haveDomain) {
        try {
            StorageClient1 storageClient = new StorageClient1();
            String info = storageClient.upload_file1(groupName, filePath, extName, null);
            if (info != null) {
                if (haveDomain) {
                    return domain + info;
                } else {
                    return info;
                }
            } else {
                LOG.error("upload file error by path: {}", filePath);
            }
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadFile(String filePath, String extName, Map<String, String> meta, boolean haveDomain) {
        try {
            StorageClient storageClient = new StorageClient();
            String[] info = storageClient.upload_file(filePath, extName, convertMeta(meta));
            if (info != null && info.length == 2) {
                return domain + info[0] + URL_SEPERATOR + info[1];
            } else {
                LOG.error("upload file error by path: {}", filePath);
            }
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public String uploadSlaveFile(String masterFileId, String prefixName, String extName, long fileSize,
            InputStream slaveIn) {
        StorageClient1 storageClient = new StorageClient1();
        try {
            String path = storageClient.upload_file1(masterFileId, prefixName, fileSize, new InputStreamUploadCallback(
                    slaveIn), extName, null);
            LOG.info("upload slave,mastFileId:{},prefixName:{},extName:{},fileSize:{},return path:{}", new Object[] {
                    masterFileId, prefixName, extName, fileSize, path });
            return path;
        } catch (Exception e) {
            LOG.error("fastdfs upload error:", e);
        }
        return null;
    }

    public static class InputStreamUploadCallback implements UploadCallback {
        private InputStream in;

        public InputStreamUploadCallback(InputStream in) {
            this.in = in;
        }

        @Override
        public int send(OutputStream out) throws IOException {
            byte[] buf = new byte[8192];
            int count = 0;
            while ((count = in.read(buf)) > 0) {
                out.write(buf, 0, count);
            }
            return count;
        }

    }

    public FileInfo getFileInfo(String fileId) {
        StorageClient1 storageClient = new StorageClient1();
        try {
            return storageClient.get_file_info1(fileId);
        } catch (Exception e) {
            LOG.error("get file info error :{}", e);
            return null;
        }
    }

    public File downloadFile(String fileId) {
        StorageClient1 storageClient = new StorageClient1();
        File temp = null;
        try {
            temp = File.createTempFile("web", "");
            temp.deleteOnExit();

            storageClient.download_file1(fileId, temp.getAbsolutePath());

            // 下载失败，比如文件不存在，并不会抛出异常，这个时候需判断并删除临时文件
            if (temp != null && temp.length() == 0) {
                temp.delete();
                return null;
            } else {
                return temp;
            }
        } catch (Exception e) {
            LOG.error("fastdfs download error:", e);
            if (temp != null && temp.exists()) {
                temp.delete();
            }
        }

        return null;
    }

    public String getFullPath(String fileId) {
        return domain + fileId;
    }

    public String getDomain() {
        return domain;
    }

    public void setDomain(String domain) {
        this.domain = domain;
    }
}
